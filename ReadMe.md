Plate PHP -- Why Query?
=======================================================
Plate PHP eliminates the boiler plate code of database queries. Plate was inspired by Django Models and Backbone Collections. Let's get setup.

1. Open ```config.php``` and make sure ```$config["db"]["mysql"]["on"]``` is set to true. Then input your database connection information. For the time being make sure Redis is set to False since this is not supported in the current release.

	```php
	$config = array();
	$config["db"]["mysql"]["on"] = True;//if using mysql;
	$config["db"]["redis"]["on"] = False;//if using redis;
		
  	if($config["db"]["mysql"] == True)
	{
		$config["db"]["mysql"]["host"] = "YOUR DATABASE HOST ADDRESS";
		$config["db"]["mysql"]["user"] = "DB USER NAME";
		$config["db"]["mysql"]["pass"] = "DB PASSWORD";
		$config["db"]["mysql"]["name"] = "DATABASE NAME";
	}
	if($config["db"]["redis"] == True)
	{
		$config["db"]["redis"]["host"] = "HOST ADDRESS";
		$config["db"]["redis"]["port"] = "PORT NUMBER";
			
	}
	```

2. Include ```plate.php``` in your code.
3. Include the static method ```Plate::Start()``` to initialize Plate PHP

<h2>Models</h2>

A Plate Models is the single source of your data. Every model should map to a single database table or document.

<h4>Defining your models</h4>
Let's create a model called ```Post```, which will represent a single blog post. In the model we'll define the data fields and database engine to use with this model, which in this case will be MySql. Note that the name of a model must match the name of your database table and that all specified data fields must match table fields in your database. 

```php
<?php
include('plate.php');
Plate::Start();

class Post
{
	public function __construct()
	{
		/*Specify the data-fields this model will access. 
		These fields must match exactly to your database table fields*/
		
		$data = array(
			'id',
			'md5_id',
			'cid',
			'uid',
			'admin',
			'remove'
		);
		$meta = array(
			'dbType' => 'mysql' //set database engine to mysql
		);
		$this->setData($data);
		$this->setMetaData($meta);
	}

}
```

<h4>Accessing a Model</h4>


Naming Convetions:
	Classes: 		CamelCase
	Methods: 		camelCase
	Properties: 	camelCase
