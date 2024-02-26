## Project Wall-E
This is a part of the test.

## Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) 

## Set up

```
    love /Volumes/Projects/wall-e [main] $ docker compose up -d
    love /Volumes/Projects/wall-e [main] $ docker exec -it walle-container bash
    root@830c49792df0:/var/www/html# composer install
```
1. Make a copy of .env.example and save it in the root dir as .env
2. Initialize the project. Run `docker compose up -d` on the terminal. This will take about 10 min to download the
   images for php and mysql. The container has custom name walle_container and mysql_container.
3. Verify project status. Run `docker exec -it walle-container bash`. If the project is running properly, you would be
   able to see `/var/www/html` on your terminal. Run `ls` and you should be able to see the project file.
    ```
    love /Volumes/Projects/wall-e [main] $ docker exec -it walle-container bash
    ```
4. Run `composer install`.
    ```
    root@830c49792df0:/var/www/html# composer install
    ```
5. Make sure port 80 (web server), 5173 (vite) and 3306 (mysql) is free. You would be able to access the project
   on [localhost]( Server running on [http://localhost:80])

## Testing

Using PHPUnit Test

1. Go to the terminal and run `docker exec -it walle-container bash`
2. Run `php artisan test` to run all the test
3. Run `php artisan test --filter RobotMovementTest`

Using Curl

```
curl --location 'http://localhost/api/robot/move' \
--header 'Content-Type: application/json' \
--data '{
"command_sequence":"N N E E W"
}'
```

## Nomenclature:

- normal variable and test class function name are using snake case
- class variable and function are using camel case
- temporary variables have '_' after $

## Limitations

1. The robot does not hold memory of past state at this time. You can imagine it as stateless machine.

## Future ToDo List

1. Make the robot to hold last location using cache/database

## Troubleshoot

- If the port is not available, go to docker-compose.yml and change ports
