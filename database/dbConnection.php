<?php 

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','chat_gpt');

//Try connecting to database
$conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

//check the connection
if($conn == false){
    echo 'Error: Cannot connect to the database';
}
?>