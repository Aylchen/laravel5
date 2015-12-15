About This Project
===================================
This project is about laravel blog which is divided into two parts : the front is used for
the normal users whose ability is to see the blogs already exists in the database, to sign in/
sign up, to publish a new blog, to comment to every blog and to edit/delete himself's articles
and comments and the backend part is for the administrators whose ability is to add/edit/delete
the permissions of all the routes, roles, admins, articles and comments. There hasn't a necessary
combination between these two parts.

How To Run This Project
===================================
###Check your environment
First of all, If you want to run this project, you need to set up all the environment that
the laravel framework requires.

###Change the permission of the storage directory
Second, you should cd into your root directory, and give the directory named storage the permission
777 in case that the framework can't access into this directory and then run errors.The command is like this:<br/>
       `sudo chmod -R 777 storage/*`

###Import sql into your database
After that, You should import the sql file which is in the sql directory relative to the root directory
into your local mysql environment.

###Generate an APP_KEY
Make sure that you are now at the root directory, you should generate a new key for the framework, the command is
like this:<br/>
       `php artisan key:generate`

###Modify your config files
1) All the framework's config files are in the config directory, first you should modify the key's value which is named
as 'key' in app.php, remove 'SomeRandomString' and enter the key that you generated last step,<br/>
2) Modify database.php file, you should type into your local mysql configuration.

###Run the server
After all the steps above finished, make sure you are at the root directory, you should run the follow command to start
the inner server:<br/>
       `php artisan serve`

###The last step
Open your browser, access `'http://localhost:8000'`, a home page which is about the readme means that you aren't in vain.


###NOTE
The admin test account:<br/>
 `Aylchen`<br/>
 `123123`