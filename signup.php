<?php 
require_once '../V-project/Include/header.php';
$sucess=0;
$user=0;
include 'dbms connection.php';

$name=$_POST['name'];
$dob=$_POST['dob']; 
$gender=$_POST['gender'];
$blood_group=$_POST['blood'];
$email=$_POST['email'];
$password=$_POST['password'];
$c_password=$_POST['confirm_password'];

$number=$_POST['number'];
$address=$_POST['address'];
   

   $sql="SELECT *FROM MEMBERS WHERE email='$email'";
    $result=mysqli_query($conn,$sql);
    if($result){
    $num=mysqli_num_rows($result);
   if($num>0){
    //echo ("error: data already exit");
    $user=1;
   }else{
        $sql="Insert into members(Name,DOB,Gender,Blood_Group_id,Email,Password,Phone,Address) values ('$name','$dob','$gender','$blood_group','$email','$password','$number','$address')";
        if(mysqli_query($conn,$sql)){
            //echo "data inserted sucessfully";
            
           $sucess=1;
           session_start();
           $_SESSION['email']='email';
           //header('Location:index.html');
      }else{
          echo ("error: ".mysqli_connect_error());
   }
 }

}

//}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
</head>

<body>
    <?php
    if($user){
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error! user alrready exit</strong>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
   }
    if($sucess){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congrates, your are suceesfully resistered</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
     ?>
       
    <div class="container-form">
        <form action="signup.php" method="post">
            <div class="form-header">Registration Form</div>
            <div class="form-body">
             
           <label for="name"> Full Name<span class="required">*</span>  </label>
            <input type="text" name="name" id="name">
            <label for="email">Email<span class="required">*</span> </label>  
            <input type="email" name="email" id="email">
            <label for="password"> Password<span class="required">*</span> </label> 
            <input type="password" name="password" id="password">
             <label for="confirm_password">Confirm Password<span class="required">*</span>  </label>
            <input type="password" name="confirm_password" id="confirm_password">
            <label for="blood">Blood Group</label>
           <select name="blood" id="blood" required> 
                <option value="">Select Blood Group</option>
                <option value="1">A+</option>
                <option value="2">A-</option>
                <option value="3">B+</option>
                <option value="4">B-</option>
                <option value="5">AB+</option>
                <option value="6">AB-</option>
                <option value="7">O+</option>
                <option value="8">O-</option>
           </select>
            <label for="number"> Phone Number<span class="required">*</span>  </label>
            <input type="number" name="number" id="number">
            <label for="address">Address<span class="required">*</span>  </label> 
            <input type="text" name="address" id="address">
            <label for="dob"> Date Of Birth<span class="required">*</span>  </label>
            <input type="date" name="dob" id="dob">
           <div class="gender" >
            <label for="gender_male">Gender<span class="required">*</span> </label> 
            <input type="radio" name="gender" value="Male" id="gender_male">
            <label for="gender_male">Male</label>
            <input type="radio" name="gender" value="Female" id="gender_female">
            <label for="gender_female">Female</label>
            <input type="radio" name="gender" value="Other" id="gender_other">
            <label for="gender_other">Other</label></div>
            <button type="submit" value="submit">Register</button>
            <a href="Login.php">You are already member, Login
            </a>
            </div>
        </form>
    </div>
</body>

</html>