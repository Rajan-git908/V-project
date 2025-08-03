<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header('location:login.html');
    exit();
}

$role=$_SESSION['role'];
if($role==='admin'){
    include 'admin_dashboard.php';

}else{
    include 'user_dashboard.php';
}

?>