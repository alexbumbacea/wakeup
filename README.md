wakeup
======

Wake on lan interface with autodiscovery

It requires
   * nbtscan to be installed for automatic discovery

Setup new instance:

    php symfony configure:database "mysql:host=localhost;dbname=wakeup" userwakeup passwakeup
    php symfony plugin:install sfDoctrineGuardPlugin
    php symfony doctrine:build --all --no-confirmation --and-load

Default username/password is : admin/admin

In order to scan the network run manually/set a cron to run

$ php ./symfony scannetwork 10.0.0.0/8 # replace this with your net mask

$ php ./symfony scannetwork 10.0.0.10-100 # replace this with your ip address range