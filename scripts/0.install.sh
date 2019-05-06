#!/bin/sh

REPOSRC="https://github.com/laravel/laravel.git"
SRCDIR="../src"
DOCDIR="../docker"
PRDIR="expo"
FLDIR=${SRCDIR}/${PRDIR}
SRCENV=${FLDIR}/.env

mkdir -p $SRCDIR
sudo chown -R nemo.nemo $SRCDIR

cd $DOCDIR
mkdir -p "process"

sudo docker-compose down
sudo docker-compose up --build -d

if [ ! -f ${SRCENV} ]
then
    sudo docker-compose exec app composer create-project laravel/laravel $PRDIR --prefer-dist
    cp ${DOCDIR}/etc/.env ${FLDIR}/.env
    cd $FLDIR
    rm -f ./.gitinore

    sudo chmod -R o+w storage
    sudo chmod -R o+w bootstrap/cache
fi

cd $DOCDIR

#sudo docker-compose exec app bash -c "cd ./${PRDIR} && composer update"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && npm install"


if [ ! -f $FLDIR'/laravel-echo-server.json' ]
then
    sudo docker-compose exec app bash -c "cd ./${PRDIR} && laravel-echo-server init"
fi

if [ -f $FLDIR'/laravel-echo-server.lock' ]
then
    sudo docker-compose exec app bash -c "cd ./${PRDIR} && laravel-echo-server stop"
fi

sudo docker-compose exec -T app bash -c "cd ./${PRDIR} && laravel-echo-server start" >>./process/laravel-echo-server.log 2>&1 &
sudo docker-compose exec -T app bash -c "php ./${PRDIR}/artisan queue:listen --tries=1" >>./process/redis-queue.log 2>&1 &


#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan migrate"
#sudo docker-compose exec app bash -c "php ./${PRDIR}/artisan db:seed"
#sudo docker-compose exec app bash -c "cd ./${PRDIR} && npm run dev"
