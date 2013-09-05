Plate PHP
=======================================================
Plate PHP eliminates the boiler plate code of database queries. Plate was inspired by Django Models/QuerySets and Backbone Models/Collections. 

<p><strong>Let's get setup.</strong></p>

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

Model Methods:
1. fetch(), 2. save(), 3. delete(), 4. filter(), 5. update()

<h4>Defining your models</h4>
Let's create a model called ```Post```, which will represent a single blog post. In the model we'll define the data fields and database engine to use with this model, which in this case will be MySql. <em>Note that the name of a model must match the name of your database table and that all specified data fields must match table fields in your database.</em>

```php
<?php
include('plate.php');
Plate::Start();

class Post extends PlateModel
{
	public function __construct()
	{
		/* Specify the data-fields this model will access. 
		These fields must match exactly to your database table fields */
		$data = array(
			'id',
			'title',
			'text',
			'user_name',
			'pub_date'
		);
		$meta = array(
			'dbType' => 'mysql' //set database engine to mysql
		);
		$this->setData($data);
		$this->setMetaData($meta);
	}

}
```

<h4>Fetch a Model: fetch()</h4>

Now that the ```Post``` model has been defined let's fetch a single Blog Post using the ```fetch()``` method.

```php
	//Define our blog post object
	$post = new Post();
	
	//Let's get a blog post with an id of 1 using the filter method
	$singlePost = $post -> filter("id=1");
	$singlePost = $singlePost -> fetch();
	
	//You can also Chain the methods
	$singlePost = $post -> filter("id=1") -> fetch();
	
	//Select a blog post by username
	$singlePost = $post -> filter("user_name = 'foo@example.com') -> fetch();
```
```
	// fetch() will return a single key with your model's data
	print_r($singlePost);
	Array
	(
		[id] 			=> 		1
		[text] 			=> 		This is my first blog post, welcome to my blog...
		[title] 		=> 		My First Blog Post
		[user_name]		=>		foo@example.com
		[pub_date]		=>		2013-08-10 13:00
	)
```

If you need to fetch multiple rows of data or if there is the possibility for multi-rows of data(ex. fetching blog posts published after July 1st could potentially return multiple posts) create a collection and fetch the collection. Collections are explained after the Model section.

<h4>Save a Model: save()</h4>

The ```save()``` method allows you to both insert new data and update existing data. A new insert is performed if the save model lacks an ```id```. If an ```id``` exists Plate looks for a field to update. Let's take a look at a couple examples. First we'll create a new Blog Post and then we'll update the same Blog Post.

```php
	$post = new Post();
	//create an array of the data we are going to insert
	$insertData = array(
		"text"		=>	"Thanks for reading. This is going to be my second blog post...",
		"title"		=>	"My Second Blog Post",
		"user_name"	=>	"foo@example.com",
		"pub_date"	=>	time()
	);
	//pass the data to the post object and save it
	$postId = $post -> setData($insertData) -> save();

	//How about we update this post's title
	//first set the data to be updated along with the post's id
	$updateData = array(
		"id"	  =>	$postId,
		"title"	  =>	"Updated Title Text"
	);
	//Set the new data, the field to be updated, the row to be updated and then save it
	$post->setData($updateData) -> update("title") -> filter("id = '$postId'") -> save();
	
```
Another example of an update using the ```save()``` method.
```php
	//We'll update the text of the post with id = 5;
	$postId = 5;
	
	$post = new Post();
	$updateData = array(
		"id"	=>	$postId,
		"text"	=>	"I decided I didn't like this blog post so I'm updating it's content..."
	);
	//Set the data, the field to be updated, the row to be updated and then save it
	$post -> setData($updateData) -> update("text") -> filter("id = '$postId'") -> save();
	
```
<h4>Delete a Model: delete()</h4>

The ```delete()``` method allows you to delete a single model. In the following example we'll delete a blog post using the ```Post``` model.

```php
	//Let's delete a post with an id of 3
	$postId = 3;
	
	$post = new Post();
	//Use the filter method to select Post 3 and then delete it
	$post -> filter("id = '$postId') -> delete();
```
<h2>Collections</h2>

A Plate collection is an ordered set of models. 

Collection Methods
1. fetch(), 2. orderBy(), 3. filter()

You can perform a number of methods on a collection, but first you'll have to define your collections. Continuing with our Blog Post example from the models section above, we'll create a collection called ```PostCollection``` that houses the 

```Post``` model.

```php
<?php
include('plate.php');
Plate::Start();

class PostCollection extends PlateCollection
{
	public function __construct()
	{
		//We need to specify this collection's model
		$this->setModel("Post");
	}

}
```

<h4>Fetch a Collection: fetch()</h4>

The fetch method when applied to a collection, will return a multi-dimensional array. Let's take a look at an example that fetches all blog posts published after July 1st, order in descending order by publication date.

```php
	//instantiate the post collection
	$posts = PostCollection();
	//filter by publication date after July1st, order by publication date in descending order and then fetch
	$multiplePosts = $posts -> filter("pub_date >= '2013-07-01'") -> orderBy("-pub_date") -> fetch();

```
```
	// fetch() will return a multi-dimensional array of blog posts
	print_r($multiplePosts);
	Array
	(
		[0] => 	array
			(
				[text] 			=> 		This is my first blog post, welcome to my blog...
				[title] 		=> 		My First Blog Post
				[user_name]		=>		foo@example.com
				[pub_date]		=>		2013-07-10 13:00
			),
		[1] => 	array
			(
				[text] 			=> 		This is my second blog post, thanks for reading...
				[title] 		=> 		Second Blog Post
				[user_name]		=>		foo@example.com
				[pub_date]		=>		2013-07-25 10:00
			),
		[2] => 	array
			(
				[text] 			=> 		This is my third blog post...your still reading this...
				[title] 		=> 		Thrid Blog Post
				[user_name]		=>		foo@example.com
				[pub_date]		=>		2013-08-05 09:00
			)
		...
	)
```

<h2>Recommended Project File Structure</h3>

```
Project Directory
 |
 +-- collections
 |  |  
 |  +-- collectionFoo.php
 |  +-- ...
 |    
 +-- models
 |  |  
 |  +-- modelFoo.php
 |  +-- ...
 |    
 +-- PlatePhp
 |  
 |
 
 ```

What's Next on the RoadMap...
=====

- [x]  Add more useful utility type methods to collections similar to backbone collections [http://backbonejs.org/#Collection]
- [ ]  Add support for Redis to the database engine
- [ ]  Add support for MongoDB to the database engine

I'm looking for contributors to help expand the capabilities of Plate PHP.
Feel free to fork it and send a pull. Any feedback and ideas are welcome!

If you decide to take a look under the hood and decide to contribute, the following file name conventions are used:

Naming Convetions:
	- Folders: 		camelCase
	- FileNames: 		CamelCase
	- Classes: 		CamelCase
	- Methods: 		camelCase
	- Properties: 		camelCase
	
