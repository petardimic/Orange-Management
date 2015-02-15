#!/bin/sh
sudo apt-get update

sudo apt-get install virtualbox-guest-dkms virtualbox-guest-utils virtualbox-guest-x11

sudo apt-get purge openjdk*

sudo apt-get install software-properties-common

sudo add-apt-repository ppa:webupd8team/java

sudo apt-get update

sudo apt-get install oracle-java8-installer

wget http://download.jetbrains.com/webide/PhpStorm-8.0.1.tar.gz

tar -zxvf PhpStorm-8.0.1.tar.gz

cd PhpStorm-138.2001.2328/bin

chmod +x phpstorm.sh

sudo apt-get install git

cd

mkdir Dev

sudo apt-get install npm

sudo npm install -g grunt-cli

sudo apt-get install nodejs

sudo ln -s /usr/bin/nodejs /usr/bin/node

cd Dev/Orange-Management

sudo npm install

sudo apt-get install curl

sudo apt-get install php5 php5-cli php5-xsl

curl -sS https://getcomposer.org/installer | php

php composer.phar install

sudo apt-get install pdepend

sudo apt-get install phploc

sudo gem install sass

sudo a2enmod headers # required for original path ?

sudo apt-get install php5-xsl

wget https://github.com/Halleck45/PhpMetrics/raw/master/build/phpmetrics.phar
chmod +x phpmetrics.phar
sudo mv phpmetrics.phar /usr/local/bin/phpmetrics