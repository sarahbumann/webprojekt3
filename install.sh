#!/bin/bash

WD=`pwd`

#prepare system
export DEBIAN_FRONTEND=noninteractive
apt -q -y update
apt -q -y upgrade
apt -q -y install composer
cd /var/www/html || exit 1
rm -Rvf ./*
rm -Rvf ./.[a-z]*

#install project
if [ -d $WD/webprojekt3 ]
then
  cp -av $WD/webprojekt3/* /var/www/html/
else
  cp -av $WD/* /var/www/html/
fi
composer update
cd /var/www/html/src/assets || exit 1
ln -s ../../vendor/fortawesome/font-awesome .
ln -s ../../vendor/twbs/bootstrap .

#install db
mysql < /var/www/html/docs/Datenbank/projekt.sql

#fix config
(
cat <<'CONFIG'
<VirtualHost *:80>
  ServerAdmin sarah.bumann@lernende.bfo-vs.ch
  DocumentRoot /var/www/html/src
  ErrorLog ${APACHE_LOG_DIR}/error.log
  CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
CONFIG
) > /etc/apache2/sites-available/000-default.conf
systemctl restart apache2

sudo -u demo firefox http://localhost > /dev/null 2>&1 &