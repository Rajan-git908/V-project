<?php
$sucess=0;
$user=0;
include_once '../V-project/Include/header.php';
include 'dbms connection.php';

$email=$_POST['email'];
$password=$_POST['password'];
$sql="Select *from members where email='$email' and password='$password'";
$result=mysqli_query($conn,$sql);
if($result){
$num=mysqli_num_rows($result);
if($num>0){
    echo " login successfull ";
    $sucess=1;
}else{
    echo "invalid creditional";
    $user=1;
}

}else{
    echo "Error:". mysqli_errno($conn);
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Css/style.css">
</head>
<body>
     <?php
    if($user){
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error! Invalid Creditionals</strong>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
    if($sucess){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congrates, your are Login Sucessfully</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
     ?>
    <div class="container-form">
        <form action="Login.php" method="post">
            <div class="form-header">Welcome to Login</div>
            <div class="form-body">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Enter Password</label>
                <input type="password" name="password" id="password">
                <button type="submit" name="submit">Log In</button>
                <a href="">Forget password</a>
                <a href="signup.php">You don't have Member</a>
                
            </div>
        </form>

    </div>
</body>
</html>
