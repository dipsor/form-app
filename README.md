## Form App
- Laravel app with react component to handle form.
- all uploaded files are stored in storage/app folder.

### Install:
1) Download the app by running:
   ```shell
   git clone git@github.com:dipsor/form-app.git
    ``` 
2) install php dependencies
   ```shell
    composer install
    ```
3) install frontend dependencies and build assets
   ```shell
    yarn
    yarn dev
    ```
4) build local env:
   
   ``` rename .env.example to .env ``` 
   ```shell
    docker-compose up
    ```
   **If database container fails during first build, stop the containers and run again** ```docker-compose up```
   **or simply restart the database container**
5) change the host you will use to access this app
   ```shell
    sudo nano /etc/hosts 
    ```
    - inside of host file add this line:
    ```shell
      127.0.0.1 form-app.test
    ```
6) ssh to container by running: 
   ```shell
     docker exec -it form-app_app_1 bash
    ```
7) inside the container migrate db:
   ```shell
      php artisan migrate
   ```
8) create ```database.sqlite``` file in database folder
9) test app by running in the container: 
    ```shell
      vendor/bin/phpunit
    ```
