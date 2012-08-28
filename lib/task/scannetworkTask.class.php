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

    $this->namespace        = '';
    $this->name             = 'scannetwork';
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
    exec('nbtscan '.$arguments['network'].' -s "|"', $output);
    foreach ($output as $line)
    {
        $arr = explode('|', $line);
        if ($arr[4]!='00:00:00:00:00:00') {
            $arr[1] = trim($arr[1]);
            $arr[0] = trim($arr[0]);
            $arr[4] = trim($arr[4]);
            $computerByMac = Doctrine_Core::getTable('computer')->findOneByMac($arr[4]);
            $computerByIP = Doctrine_Core::getTable('computer')->findOneByIP($arr[0]);
            $computerByName = Doctrine_Core::getTable('computer')->findOneByName($arr[1]);
            if (empty($computerByMac)) {
                echo 'Computer not found by MAC - '.$arr[4]."\n";
                if (!empty($computerByIP)) {
                    $computerByIP->delete();
                }
                if (!empty($computerByName)) {
                    $computerByName->delete();
                }
                $computerByMac = new computer();
            } else {
                if (!empty($computerByIP) && $computerByMac->getId() != $computerByIP->getId()) $computerByIP->delete();
                if (!empty($computerByName) && $computerByMac->getId() != $computerByName->getId()) $computerByName->delete();
            }
            $computerByMac->setIp($arr[0]);
            $computerByMac->setName($arr[1]);
            $computerByMac->setMac($arr[4]);
            $computerByMac->save();
            echo "Computer saved ".$computerByMac->getName()."!\n";
        }
    }
    // add your code here
  }
}
