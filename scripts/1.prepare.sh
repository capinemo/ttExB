#!/bin/sh

DOCDIR="../docker"
PRDIR="expo"

cd $DOCDIR

sudo docker-compose exec app bash -c "cd ./${PRDIR} && php artisan migrate"