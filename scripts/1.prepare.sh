#!/bin/sh

DOCDIR="../docker"
PRDIR="expo"

cd $DOCDIR

#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:middleware CheckAuthKey"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:model Models/Source"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:model Models/Template"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:model Models/Block"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:model Models/NumberRec"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:model Models/GraphRec"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:seeder SourceTableSeeder"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:seeder TemplateTableSeeder"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:seeder BlockTableSeeder"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:seeder NumberRecTableSeeder"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan make:seeder GraphRecTableSeeder"

sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan migrate"
sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan db:seed"

