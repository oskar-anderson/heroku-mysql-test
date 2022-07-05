<?php
echo "Hello Heroku!" . '<br>';


//Get Heroku ClearDB connection information

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$mysqli = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

$resource = $mysqli -> query("SELECT * FROM `HelloHeroku`;");
echo "Returned rows are: " . $resource->num_rows . '<br>';
while ( $row = $resource->fetch_array() ) {
   echo "{$row['Name']}"  . '<br>';
}
$resource->free();
$mysqli -> close();

?>