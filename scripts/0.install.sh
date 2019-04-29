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
sudo docker-compose down
sudo docker-compose up -d --build

if [ ! -f ${SRCENV} ]
then
    sudo docker-compose exec app composer create-project laravel/laravel $PRDIR --prefer-dist

    cd $FLDIR
    rm -f ./.gitinore

    sudo chmod -R o+w storage
    sudo chmod -R o+w bootstrap/cache
else
    sudo docker-compose exec app bash -c "cd ./${PRDIR} && composer update"
fi
