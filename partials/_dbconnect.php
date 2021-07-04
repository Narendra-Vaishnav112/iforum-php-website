<?php
// code to connect to the database
$servername="localhost";
$username="root";
$password="";
$db="iforum";

$conn=mysqli_connect($servername, $username , $password , $db);

if(!$conn){
    echo "database can not be connet due to ",mysqli_connect_error();
}





?>