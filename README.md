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
3) install frontend dependencies
   ```shell
    yarn
    ```
4) run docker and then build containers by running:
   ```shell
    docker-compose up
    ```
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
