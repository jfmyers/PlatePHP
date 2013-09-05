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

<h2>Models</h2>

A Plate Models is the single source of your data. Every model should map to a single database table or document. The first step is defining your Plate Models.



<h3>Simple Setup</h3>
Naming Convetions:
	Classes: 		CamelCase
	Methods: 		camelCase
	Properties: 	camelCase
