wakeup
======
## General info

This application was built in order to allow turning on the computers 
for users using VPN connections after a power management policy was in place.

This application will help you reduce your costs with electricity and also becoming 
a green organization.

In order to use this app you'll have to enable in BIOS WOL feature.

Wake on lan interface with autodiscovery. The app will try to discover hosts based on enabled services:
* Windows/RDP - remote desktop. It will try to check if port 3389 is responding
* Webserver - will check if any application is listening on port 80
* Linux/SSH - will check if any application is listening on port 22

## Setup new instance:

    php symfony configure:database "mysql:host=localhost;dbname=wakeup" userwakeup passwakeup
    php symfony plugin:install sfDoctrineGuardPlugin
    php symfony doctrine:build --all --no-confirmation --and-load
    php ./symfony scannetwork 10.0.0.0/24 # replace this with your net mask
    php ./symfony scannetwork 10.0.0.10-10.0.0.100 # replace this with your ip address range   
    php ./symfony scannetwork 10.0.0.10/255.255.255.0 # replace this with your ip address range   
    
Default username/password is : admin/admin

