#!/bin/bash

/usr/bin/python /var/www/html/crm/public/scripts/get.py > /var/log/crm.log 2>&1
/usr/bin/python /var/www/html/crm/public/scripts/geto.py > /var/log/crm.log 2>&1
/usr/bin/python /var/www/html/crm/public/scripts/getc.py > /var/log/crm.log 2>&1