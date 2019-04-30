#!/bin/sh

DOCDIR="../docker"
PRDIR="expo"

cd $DOCDIR

#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:middleware CheckAuthKey"
sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan migrate"

