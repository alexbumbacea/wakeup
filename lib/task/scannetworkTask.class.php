<?php

class scannetworkTask extends sfBaseTask
{
    protected function configure()
    {
        $this->addArguments(array(
            new sfCommandArgument('network', sfCommandArgument::REQUIRED, 'Network to be scanned'),
        ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine')
            // add your own options here
        ));

        $this->namespace = '';
        $this->name = 'scannetwork';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [scannetwork|INFO] task does things.
Call it with:

  [php symfony scannetwork|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {
        // initialize the database connection
        $databaseManager = new sfDatabaseManager($this->configuration);
        $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
        $ips = $this->_getIpRange($arguments['network']);
        foreach ($ips as $ip) {
            $this->log($ip . " checking!");
            $cmp = Doctrine_Core::getTable('computer')->findOneByIP($ip);
            if (!$cmp) {
                $cmp = new computer();
                $cmp->setIp($ip);
            }
            foreach ($cmp->getAvailableComputerTypes() as $key => $label) {
                //try checking if host on by any method
                $cmp->setType($key);
                //if host awake, stop any further verifications and save it to database
                if ($cmp->verityStatus()) {
                    // try to find mac
                    $macAddress = $this->_macByIp($cmp->getIp());
                    //something is wrong, we can't communicate on level 2
                    if (!$macAddress) throw new Exception("Unable to determine MAC address for IP {$cmp->getIp()}");
                    //try to find any previous records with same MAC. If found, discard new record, alter the existing one
                    /* @var $computerByMac computer */
                    $computerByMac = Doctrine_Core::getTable('computer')->findOneByMac($macAddress);
                    if ($computerByMac) {
                        $computerByMac->setIp($cmp->getIp());
                        $cmp = $computerByMac;
                    }
                    $cmp->setMac($macAddress);
                    //if emtpy hostname put ip
                    if (strlen($cmp->getName()) == 0) {
                        $cmp->setName($cmp->getIp());
                    }
                    //TODO: detect hostname

                    $cmp->save();
                    $this->log($cmp->getIp() . " is alive based on $label!");
                    break;
                }
            }
        }
    }

    /**
     * @param $range string
     * @return array
     */
    private function _getIpRange($range)
    {
        $ipRegex = computer::IP_REGEX;
        if (preg_match("/^({$ipRegex})\-({$ipRegex})$/", $range)) {
            // 192.168.1.1-192.168.1.100
            $matches = explode('-', $range);
            return $this->_getIpRangeDash($matches[0], $matches[1]);
        } elseif (preg_match("/^{$ipRegex}\/{$ipRegex}$/", $range)) {
            //192.168.1.100/255.255.255.0
            $matches = explode('/', $range);
            return $this->_getIpRangeSlash($matches[0], $this->_convertMaskToNumber($matches[1]));

        } elseif (preg_match("/^{$ipRegex}\/\d{1-2}$/", $range)) {
            //192.168.1.0/24
            $matches = explode('/', $range);
            return $this->_getIpRangeSlash($matches[0], $matches[1]);
        } elseif (preg_match("/^{$ipRegex}$/", $range)){
          //check only one host
            return $this->_getIpRangeDash($range, $range);
        } else {
            $this->log('Network format not recognized!');
            die;
        }
    }

    /**
     * @param $mask
     * @return int
     */
    private function _convertMaskToNumber($mask)
    {
        $cidr = 0;
        foreach (explode('.', $mask) as $number) {
            for (; $number > 0; $number = ($number << 1) % 256) {
                $cidr++;
            }
        }
        return $cidr;
    }

    /**
     * @param $baseIp string
     * @param $mask int
     * @return array
     */
    private function _getIpRangeSlash($baseIp, $cidr)
    {
        $range[0] = long2ip((ip2long($baseIp)) & ((-1 << (32 - (int)$cidr))));
        $range[1] = long2ip((ip2long($baseIp)) + pow(2, (32 - (int)$cidr)) - 1);
        return $this->_getIpRangeDash($range[0], $range[1]);
    }

    /**
     * @param $start string
     * @param $end string
     * @return array
     */
    private function _getIpRangeDash($start, $end)
    {
        $startIp = ip2long($start);
        $endIp = ip2long($end);
        $ipAddresses = array();
        for ($i = $startIp; $i <= $endIp; $i++)
            $ipAddresses[] = long2ip($i);
        return $ipAddresses;
    }

    /**
     * Uses arp binary from system to detect the IP address
     * @param $ip string
     * @return string
     */
    private function _macByIp($ip) {
        exec("/usr/sbin/arp -n $ip", $data);
        if (preg_match("/".computer::MAC_REGEX."/", $data[1], $matches)){
            return $matches[0];
        };
        return false;

    }


}
