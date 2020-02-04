## Steps to do after cloning.

- If .env does not exist, create a .env file using the .env-example template and change the database name.
- In command prompt, direct to the directory of the cloned repository. Example: 
``` cd c:\xampp\htdocs\C200Worldskills ```
- Follow these steps in the terminal:
   1. ``` npm install```
   2. ```npm run watch```
   3. open new terminal
   4. ```composer udpate```
   5. ```php artisan config:Cache```
   6. ```php artisan cache:clear```
   7. ```php artisan view:clear```
   8. ```php artisan route:clear```
- Import the sql file ```sample-data-worldskills.sql``` in the sql folder of the project

- Lastly, in the terminal:
   1. Type ```php artisan key:generate``` to generate the key for Laravel
   2. ```php artisan serve```
