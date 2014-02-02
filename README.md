project-mgmt
============

M2 - Project Management

Requirements
------------

To run this project on your machine, you need the following software :
* Apache ;
    * Rewrite mod enabled ;
    * PHP support enabled ;
* Any DBMS supported by Symfony2, and more precisely by Doctrine 2 ;
* PHP 5.3 or higher.

Installation (Debian GNU/Linux)
-------------------------------

### Cloning the project
    $ git clone git@github.com:alex-ception/project-mgmt.git
    $ cd project-mgmt

### Installing/updating vendors and libraries
    $ ./composer.phar selfupdate
    $ ./composer.phar update

### Adding the vhost to Apache
    $ sudo su
    EnterYourPassword
    # cd /etc/apache2/sites-available/
    # touch project-mgmt.loc
    # a2ensite project-mgmt.loc
    # /etc/init.d/apache2 restart

### Adding the domaine project-mgmt to your hosts file
    # echo "127.0.0.1 project-mgmt.loc" >> /etc/hosts

### Installing setfacl for permissions (if necessary)
    # apt-get update && apt-get install setfacl
    # exit

### Configuring system permissions on cache & logs
    $ sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX app/cache app/logs
    $ sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx app/cache app/logs

### Configuring app/config/parameters.yml file

And especially the following variables :
    `database_driver: pdo_mysql`
    `database_host: 127.0.0.1`
    `database_port: null`
    `database_name: YourDBName`
    `database_user: YourUsername`
    `database_password: YourPassword`

Make sur your database exists and your user can modify it !

### Generate the tables (in development mode)

    $ ./app/console doctrine:schema:update --force
