<?php
/*
THIS FILE CONTAINS DATABASE CONFIGURATION ASSUMING YOU ARE RUNNING mysql using user "root" and password ""
*/
define('db_server','localhost');
define('db_username','root');
define('db_password','');
define('db_name','rdbms');

//try connecting to the database
$conn=mysqli_connect(db_server,db_username,db_password,db_name);

//check the connection

if($conn==false)
{
    die('Error: Cannot connect!');
}
?>