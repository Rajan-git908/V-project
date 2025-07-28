<?php
$server="localhost";
$username="root";
$password="R@jan12#";
$dbname="Blood_anagementdb";

$conn=mysqli_connect($server,$username,$password,$dbname);
if(!$conn){
    die ("Connection error: ".mysqli_connect());
}

?>