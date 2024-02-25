## Project Wall-E
This is a part of the test.

## Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) 

## Set up

1. Make a copy of .env.example and save it in the root dir as .env
2. Initialize the project. Run `docker compose up -d` on the terminal. This will take about 10 min to download the
   images for php and mysql. The container has custom name walle_container and mysql_container.
3. Verify project status. Run `docker exec -it walle-container bash`. If the project is running properly, you would be
   able to see `/var/www/html` on your terminal. Run `ls` and you should be able to see the project file.
4. Make sure port 80 (web) and 3306 (mysql) is free. You would be able to access the project on [localhost]( Server
   running on [http://localhost:80])
