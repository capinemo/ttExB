#!/bin/sh

DOCDIR="../docker"
PRDIR="expo"

cd $DOCDIR

#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:middleware CheckAuthKey"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:model Models/Source"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:model Models/Template"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:model Models/Block"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:model Models/NumberRec"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan make:model Models/GraphRec"


sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan migrate"

