**With webserver**
If you are using a web server, clone the project in the corresponding folder of your webserver ("www" in WAMP, "htdocs" in XAMPP or MAMP). Then you can access the project in your browser by navigating to "localhost/{path}" (i.e. www > wastemanager -> localhost/wastemanager).
***
**Without webserver**
If you are not using a web server, you have to download PHP and install it in a folder (i.e. C:/php). Then, you have to add the folder to the Environment Variable Path. Now you can clone the project, go to the folder and use the following commands
* `php file_name.php` // _run the file in terminal_
* `php -S localhost:port -t your_folder/` // _start a server for testing the php code_