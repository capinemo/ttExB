# ttExB
Graphs and numbers report api

Installation:
1. Install docker (docker-compose);

2. Clone
> git clone https://github.com/capinemo/ttExB.git .

3. Run install script
> ./scripts/0.install.sh

4. Add cron schedule for host crontab
>crontab -e

4.1 Copy and save cron file
* * * * *  docker-compose -f '/home/nemo/develop/project/testExpoBank/docker/docker-compose.yml' exec \
 app bash -c "php ./expo/artisan schedule:run" >>/dev/null 2>&1

5.