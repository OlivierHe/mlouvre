#!/bin/bash

# clear du cache prod sf
php bin/console cache:clear --env=prod

chgrp -R www-data /usr/share/nginx/html/mlouvre/var/cache/prod/ /usr/share/nginx/html/mlouvre/var/cache/prod/twig/ /usr/share/nginx/html/mlouvre/var/cache/prod/pools/ /usr/share/nginx/html/mlouvre/var/cache/prod/pools/++V1SiXAJV/
 
chmod -R g+rwX /usr/share/nginx/html/mlouvre/var/cache/prod/
chmod -R g+rwX /usr/share/nginx/html/mlouvre/var/cache/prod/twig/
chmod -R g+rwX /usr/share/nginx/html/mlouvre/var/cache/prod/pools/
chmod -R g+rwX /usr/share/nginx/html/mlouvre/var/cache/prod/pools/++V1SiXAJV/
chmod -R g+rwX /usr/share/nginx/html/mlouvre/var/cache/prod/classes.map
