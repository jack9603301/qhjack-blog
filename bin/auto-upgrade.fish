#!/usr/bin/env fish
chown nginx:nginx -R /var/www/qhjack
/var/www/qhjack/bin/gpm selfupgrade -f -y
