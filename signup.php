<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
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