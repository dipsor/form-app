## Form App
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
   - rename .env.example to .env 
   ```shell
    docker-compose up
    ```
   **If database container fails during first build, stop the containers and run again** ```docker-compose up```
5) change the host you will use to access this app
   ```shell
    sudo nano /etc/hosts 
    ```
    - inside of host file add this line:
    ```shell
      127.0.0.1 form-app.test
    ```
6) int he root folder of the project rename .env.example to .env
           
7) ssh to container by running: 
   ```shell
     docker exec -it form-app_app_1 bash
    ```
8) inside the container migrate db:
   ```shell
      php artisan migrate
   ```
