<?php 
$sucess=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='post'){
    include 'dbms connection.php';

$name=$_POST['name'];
$dob=$_POST['dob']; 
$gender=$_POST['gender'];
$blood_group=$_POST['blood_group'];
$email=$_POST['email'];
$password=$_POST['password'];
$c_password=$_POST['confirm_password'];

$number=$_POST['number'];
$address=$_POST['address'];
   


$sql="SELECT *FROM MEMBERS WHERE $email='email";
$result=mysqli_query($conn,$sql);
if($result){
    $num=mysqli_num_rows($result);
    if($num>0){
            $user=1;
    }else{
        $sql="Insert into member(Name,DOB,Gender,Blood_Group,Email,Password,Phone,Address) values ('$name','$dob','$gender','$blood_group','$email','$password','$phone','$address')";
        if(mysqli_query($conn,$sql)){
            $sucess=1;
        }else{
             echo mysqli_connect_error($conn);
        }
    }

}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
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
             
            <label >Name<span class="required">*</span></label>
            <input type="text" name="name">
            <label >Email<span class="required">*</span></label>
            <input type="email" class="email">
            <label >Password<span class="required">*</span></label>
            <input type="password" name="password">
            <label >Confirm Password<span class="required">*</span></label>
            <input type="password" name="confirm_password">
            <label >Blood Group<span class="required">*</span></label>
           <select name="blood_group" id=""> 
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
           </select>
            <label >Phone Number<span class="required">*</span></label>
            <input type="number" name="number">
            <label >Address<span class="required">*</span></label>
            <input type="text" name="address">
            <label >Date Of Birth<span class="required">*</span></label>
            <input type="date" name="dob">
           <div class="gender"><label >Gender<span class="required">*</span></label>
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Female">Female
            <input type="radio" name="gender" value="Other">Other</div>
            <button type="submit" value="submit">Register</button>
            </div>
        </form>
    </div>
</body>

</html>