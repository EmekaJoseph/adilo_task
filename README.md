The project is built in two folders, **adilo_api** (Laravel-PHP) and **adilo_vue** (Vue- Javascript),
This means on Local, it has to be have to run sperately.
 
 # How to Install
 1. make sure your local server is running (e.g: Laragon - in my case)
 2. Create a database in your local server called 'adilo_task' or any name depending on what you will change it to in your .env file
 3. git pull both '**adilo_api**'  and '**adilo_vue**' folders seperately
 4. In the **adilo_api** folder, rename '.env.example' file to '.env'
 5. In the **adilo_api** folder, run the following commands:
    - 'composer install'
    - 'php artisan migrate'
    - 'php artisan db:seed'
    - 'php artisan serve'
  Your backend should be up and running on port 'http://127.0.0.1:8080'.
 6. In the **adilo_vue** folder, rename '.env.example' file to '.env'
 7. In the **adilo_vue** folder, run the following commands:
    - 'npm install'
    - 'npm run dev'
  Your frontend should be up and running on port 'http://127.0.0.1:8888'. (you can change this in 'package.json' file but not neccessary)
 8. Please visit 'http://127.0.0.1:8888' to see the application.

 # NOTE
 I applied the sanctum correctly but I didn't apply any authentication(login) from the frontend,
 I also did not understand the usage of the 'basic queue job that simulates video processing'
