<?php
$sucess=0;
include 'dbms connection.php';

// Insert logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $donor_id = $_POST['donor_id'];
    $receiver_id = $_POST['receiver_id'];
    $request_id = $_POST['request_id'];
    $patient_name = $_POST['patient_name'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];
    $donation_date = $_POST['donation_date'];
    $remarks = $_POST['remarks'];

    // Handle Image Upload
    $image_path = '';
    if (!empty($_FILES['donation_image']['name'])) {
        $target_dir = "uploads/";
        $image_path = $target_dir . basename($_FILES["donation_image"]["name"]);
        move_uploaded_file($_FILES["donation_image"]["tmp_name"], $image_path);
    }

    $sql = "INSERT INTO donation_history (donor_id, receiver_id, request_id, patient_name, blood_group, location, donation_date, image_path, remarks) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiissssss", $donor_id, $receiver_id, $request_id, $patient_name, $blood_group, $location, $donation_date, $image_path, $remarks);

    if ($stmt->execute()) {
        echo "Donation recorded successfully.";
        // You may want to update request status too!
    } else {
        echo "Error: " . $stmt->error;
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
    <link rel="stylesheet" href="Css/dashboard.css">
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

<div class="container-form">
<form method="post" action="donate.php">
    <div class="form-body">
    <label for="user_id">Donor Id:</label>
    <select name="user_id" id="user_id" required>
        <?php
        // Fetch members from members table
        $members = $conn->query("SELECT user_id, Name FROM members");
        while ($row = $members->fetch_assoc()) {
            echo "<option value='{$row['user_id']}'>{$row['user_id']}</option>";
        }
        ?>
    </select>

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
    <input type="text" name="location" id="location" required>

    <label for="receiver_name">Receiver Name:</label>
    <input type="text" name="receiver_name" id="receiver_name" required>

    <label for="date">Donation Date:</label>
    <input type="date" name="date" id="date" required>

    <input type="submit" value="Record Donation">
    </div>
</form>

</div>
