wakeup
======

Wake on lan interface with autodiscovery

It requires
   * http auth to be enabled ( for easy integration with Active Directory and other login platforms)
   * nbtscan to be installed for automatic discovery


In order to scan the network run manually/set a cron to run

$ php ./symfony scannetwork 10.0.0.0/8 # replace this with your net mask
$ php ./symfony scannetwork 10.0.0.10-100 # replace this with your ip address range