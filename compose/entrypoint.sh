#!/bin/bash
set -e

php -r '
$dbhost = @$_ENV["DB_HOST"] ?: "db";
$dbname = @$_ENV["DB_NAME"] ?: "mapas";
$dbuser = @$_ENV["DB_USER"] ?: "mapas";
$dbpass = @$_ENV["DB_PASS"] ?: "mapas";

echo "\naguardando o banco de dados subir corretamente...";

while(true){
    try {
        new PDO("pgsql:host={$dbhost};port=5432;dbname={$dbname};user={$dbuser};password={$dbpass}");
        echo "\nconectado com sucesso ao banco pgsql:host={$dbhost};port=5432;dbname={$dbname};user={$dbuser};\n";
        break;
    } catch (Exception $e) {
        echo "..";        
    }
    sleep(1);
}
'
rm -rfv /var/www/html/protected/application/plugins/AldirBlanc
rm -rfv /var/www/html/protected/application/plugins/MultipleLocalAuth
rm -rfv /var/www/html/protected/application/plugins/MultipleLocalAuth/Facebook/FacebookStrategy.php

git clone https://github.com/mapasculturais/plugin-AldirBlanc /var/www/html/protected/application/plugins/AldirBlanc
git clone https://github.com/mapasculturais/plugin-MultipleLocalAuth /var/www/html/protected/application/plugins/MultipleLocalAuth
curl https://raw.githubusercontent.com/opauth/facebook/master/FacebookStrategy.php > /var/www/html/protected/application/plugins/MultipleLocalAuth/Facebook/FacebookStrategy.php

if [ ! -f /.deployed ]; then
    cd /var/www/scripts
    ./deploy.sh
#    touch /.deployed
fi

mkdir /var/www/html/assets
mkdir /var/www/html/files
mkdir /var/www/private-files

#chown -R www-data:www-data /var/www/html/assets /var/www/html/files /var/www/private-files

nohup /recreate-pending-pcache-cron.sh &

exec "$@"
