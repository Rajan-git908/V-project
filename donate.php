<?php
$sucess=0;
include 'dbms connection.php';

// Insert logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];
    $receiver_name=$_POST['receiver_name'];
    $date = $_POST['date'];

    $sql= "INSERT INTO donation (user_id, blood_group, location, Receiver_Name, date) VALUES ('$user_id','$blood_group', '$location', '$receiver_name','$date')";
    if(mysqli_query($conn,$sql)) {
        //echo "Donation record inserted successfully.";
        $sucess=1;
        header('location:admin_dashboard.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
</head>
<body>
    
</body>
</html>
<?php

if($sucess){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Sucessfully added...</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
<!-- HTML Form -->
<form method="post" action="donate.php">
    <label for="user_id">Donor Id:</label>
    <select name="user_id" id="user_id" required>
        <?php
        // Fetch members from members table
        $members = $conn->query("SELECT user_id, Name FROM members");
        while ($row = $members->fetch_assoc()) {
            echo "<option value='{$row['user_id']}'>{$row['user_id']}</option>";
        }
        ?>
    </select><br>

    <label for="blood_group">Blood Group:</label>
         <select name="blood_group" id="blood_group" required>
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
    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required><br>

    <label for="receiver_name">Receiver Name:</label>
    <input type="text" name="receiver_name" id="receiver_name" required><br>

    <label for="date">Donation Date:</label>
    <input type="date" name="date" id="date" required><br>

    <input type="submit" value="Record Donation">
</form>


