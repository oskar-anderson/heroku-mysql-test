<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>
   <h1>Hello Mom!</h1>
   <?php


   //Get Heroku ClearDB connection information

   $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
   $cleardb_server = $cleardb_url["host"];
   $cleardb_username = $cleardb_url["user"];
   $cleardb_password = $cleardb_url["pass"];
   $cleardb_db = substr($cleardb_url["path"],1);

   // Connect to DB
   $mysqli = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

   if ($mysqli -> connect_errno) {
      echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
      exit();
   }

   $resource = $mysqli -> query("SELECT * FROM `helloheroku`;");
   echo "Returned rows: {$resource->num_rows} <br>";
   while ($row = $resource->fetch_array() ) {
      echo "{$row['Name']}"  . '<br>';
   }
   $resource->free();
   $mysqli -> close();

   ?>
</body>
</html>

