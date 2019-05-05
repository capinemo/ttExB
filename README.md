# ttExB
Graphs and numbers report api

ADD ./docker/etc/cron content to crontab -e
* * * * *  docker-compose -f '/home/nemo/develop/project/testExpoBank/docker/docker-compose.yml' exec app bash -c "php ./expo/artisan schedule:run" >>/dev/null 2>&1
