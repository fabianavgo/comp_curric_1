# CakeStrap v 0.5
---
CakeStrap is a simple HTML5 Ready Bootstrap for CakePHP 2.2 Applications.


### Video tutorial ( Portuguese )
[http://youtu.be/m4FtYIS3Rm8][]
[http://youtu.be/m4FtYIS3Rm8]: http://youtu.be/m4FtYIS3Rm8


### Features
##### Front-end
1. Responsive Web Design
2. HTML5 Boilerplate v4.0.0
3. Normalize v1.0.1
4. Modernizr v2.6.1
5. Twitter Bootstrap v2.1.0
6. Multi-Language ( English and Portuguese )
7. Custom themes ( Bootswatch ) **(NEW)**

##### Back-end
1. CakePHP 2.2 Security Authentication
2. Users CRUD
3. Remember password with email send
4. Automatic inclusion of  javascript and css files depending of the current controller and action ( Tutorial below ) **(NEW)**


## Quick start

- Create a table named `fones` in your database with the following structure:


<pre>CREATE TABLE fones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Marca VARCHAR(50),
    Modelo VARCHAR(50),
    tipo TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

INSERT INTO fones (Marca, Modelo,tipo, created)
    VALUES ('Sony', 'Modelo a2', 'Headset', NOW());
INSERT INTO fones (Marca, Modelo, tipo, created)
    VALUES ('Philips', 'Modelo a5', 'Headset', NOW());
INSERT INTO fones (Marca, Modelo, tipo, created)
    VALUES ('Sony', 'Modelo h567', 'AB', NOW());
</pre>


- Open the file `app/Config/database.php` and change the database information
- Change the permissions of the folder `app/tmp` to 777 ( and all the folders inside of it )
- Change your app name and email in `app/Config/bootstrap.php` at line 149
- Change your SMTP email settings in `app/Config/email.php` at line 66


## Automatic inclusion of JS and CSS
CakeStrap has a JS and CSS folder structure allowing to automatic load files for each action of each controller.
For example, if you have this JS structure folder:

<pre>
/js
	/pages
		/home.js		
</pre>

This script will be automatic loaded when the user is in controller `pages` and in action `home`

The same structure exists for `CSS` files.

## Internationalization

Currently cakeStrap supports two languages, **English** and **Portuguese**. To enable the Portuguese language as the main just add the following line in your `app/Controllers/AppController.php` at `beforeFilter` action:
<pre>
Configure::write('Config.language', 'por');
</pre> 



## Questions / Bugs

Have a question or found a bug? Please create an issue [here][] on GitHub!
[here]: https://github.com/hugodias/cakestrap/issues
