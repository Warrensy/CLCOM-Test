# social_network

## Social Network
This is a simple social network, built using PHP and MySQL.

## Stack
### PHP
The main functionalities and server side logic has been implemented using PHP.

### HTML5, CSS & Bootstrap
The layout of the social network has been built with HTML5.
Design, style as well as responsivness was implemented with Bootstrap 4.

### MySQL
The database has been built using MySQL engine.

## Installation
1. Move the social_network folder to your htdocs folder.
2. Start your apache web server and MySQL database in XAMPP.
3. Database setup:
* Go to your phpmyadmin, create a database called ``social network``.
* Next, select the database and go to ``import``. 
* Then you can select the file from which you want to import with ``choose file`` button. 
Select the file ``db.sql``, you can find it under ``social_network/db.sql``. Press ``go`` and all the tables and 
demo data should have been created.
* Make sure the primery key (id) in the ``comments`` table is set to auto_increment.
4. The project assumes the database user with following credentials exists: username: socialNetwork, password: 1234. 
If not, follow the steps bellow for configuration:
* Go to ``social_network/config/dbaccess.php``
* Edit the ``$USERNAME`` and ``$PASSWORD`` variables, set them to a database user who has access to your MySQL.
5. Go to your webbrowser and go to your localhost. The social network should be displayed.

### Sample users
You can use the following users to access the social network:
* username: ``admin``, password: ``123456``
* username: ``user``, password: ``123456``
Or you can register yourself using the link ``<YOUR_XAMPP_ADDRESS>/social_network/index.php?action=register``

### Classes
#### db.class.php
Contains all functionalities needed to query, update, delete or insert data into the database.

#### comments.class.php
This class serves as a model for comments. It contains getters and setters for the comment model.

#### post.class.php
This class serves as a model for the posts. It contains getters and setters for the post model.

#### user.class.php
This class serves as a model for the users. It contains getters and setters for the user model.