#!/bin/bash

sudo rm -r /var/www/html/hvdocente
sudo cp -r hvdocente /var/www/html
sudo cp hvdocente/server/database.php /var/www/html/hvdocente
sudo chmod -R a+rwx /var/www/html/hvdocente/storage/

