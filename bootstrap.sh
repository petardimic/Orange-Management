#!/usr/bin/env bash

# Set MySQL root password
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password password s4b3r?'
debconf-set-selections <<< 'mysql-server-5.5 mysql-server/root_password_again password s4b3r?'

# Install packages
apt-get update
apt-get install -y mysql-server-5.5 php5-mysql libsqlite3-dev apache2 php5 php5-dev build-essential php-pear ruby1.9.1-dev memcached libmemcached-tools
rm -rf /var/www
ln -fs /vagrant /var/www

# Install memcache
yes | pecl install memcache 2> /dev/null

sudo touch /etc/php5/conf.d/memcache.ini
sudo echo "extension=memcache.so" >> /etc/php5/conf.d/memcache.ini
sudo echo "memcache.hash_strategy=\"consistent\"" >> /etc/php5/conf.d/memcache.ini

# Add ServerName to httpd.conf for localhost
echo "ServerName localhost" > /etc/apache2/httpd.conf
# Enable "mod_rewrite"
a2enmod rewrite

# Set timezone
echo "America/New_York" | tee /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

# Setup database
echo "DROP DATABASE IF EXISTS test" | mysql -uroot -proot
echo "CREATE USER 'devdb'@'localhost' IDENTIFIED BY 'devdb'" | mysql -uroot -proot
echo "CREATE DATABASE devdb" | mysql -uroot -proot
echo "GRANT ALL ON devdb.* TO 'devdb'@'localhost'" | mysql -uroot -proot
echo "FLUSH PRIVILEGES" | mysql -uroot -proot

service apache2 restart