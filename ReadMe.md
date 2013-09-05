Plate PHP -- Why Query?
=======================================================
Plate PHP eliminates the boiler plate code of database queries. Plate was inspired by Django Models and Backbone Collections.

<h3>Simple Setup</h3>
<ol>
<li>
Open config.php and make sure the mysql option is set to true. Then input your database connection information. For the time being make sure Redis is set to False since this is not supported in the current release.
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
</li>
<li>
Include plate.php in your code.
</li>


<h3>Simple Setup</h3>
Naming Convetions:
	Classes: 		CamelCase
	Methods: 		camelCase
	Properties: 	camelCase

```php
if( $config["db"]["mysql"] == True ){
	$config["db"]["mysql"]["host"] = "YOUR DATABASE HOST";
	$config["db"]["mysql"]["user"] = "DB USER NAME";
	$config["db"]["mysql"]["pass"] = "DB PASSWORD";
	$config["db"]["mysql"]["name"] = "DATABASE NAME";
}
```
