<?php

$servername="localhost";
$username = "root";
$password = "";

$db_name = "db_cnow1";

$conn = mysqli_connect($servername,$username,$password, $db_name);

if(!$conn){
    echo"Ket noi that bai";
}