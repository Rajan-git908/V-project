<?php 
session_start();
include 'dbms connection.php';
$user_id=$_SESSION['user_id'];

$sql="select *from members where user_id=?";
$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"i",$user_id);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);

if($row=mysqli_fetch_assoc($result)){
    echo json_encode($row);
} else{
    echo json_encode(["error"=>"user not found"]);
}
?>