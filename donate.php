<?php
$success = 0;
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
        $image_path = $target_dir . basename($_FILES["imdonation_image"]["name"]);
        move_uploaded_file($_FILES["donation_image"]["tmp_name"], $image_path);
    }

    $sql = "INSERT INTO donation_history (donor_id, receiver_id, request_id, patient_name, blood_group, location, donation_date, image_path, remarks) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiissssss", $donor_id, $receiver_id, $request_id, $patient_name, $blood_group, $location, $donation_date, $image_path, $remarks);

    if ($stmt->execute()) {
        $success = 1;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Css/dashboard.css">
</head>

<body>

</body>

</html>
<?php

if ($success) {
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
            <select name="donor_id" id="donor_id" required>
                <?php
                $members = $conn->query("SELECT user_id, Name FROM members");
                while ($row = $members->fetch_assoc()) {
                    echo "<option value='{$row['user_id']}'>{$row['user_id']}</option>";
                }
                ?>
            </select>
            <?php $abc = $conn->query("SELECT request_id FROM blood_request"); ?>
            <label for="request_id">Request Id:</label>
            <select name="request_id" id="request_id" required>
                <?php
                $abc = $conn->query("SELECT request_id FROM blood_request");
                while ($row = $abc->fetch_assoc()) {
                    echo "<option value='{$row['request_id']}'>{$row['request_id']}</option>";
                }
                ?>
            </select>
            <label for="receiver_id">Receiver Id:</label>
            <select name="receiver_id" id="receiver_id" required>
                <?php
                $abc = $conn->query("SELECT request_id FROM blood_request");
                while ($row = $abc->fetch_assoc()) {
                    echo "<option value='{$row['request_id']}'>{$row['request_id']}</option>";
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
            <select name="location" id="location" required>
                <?php
                $abc = $conn->query("SELECT request_id, location FROM blood_request");
                while ($row = $abc->fetch_assoc()) {
                    echo "<option value='{$row['location']}'>{$row['location']}</option>";
                }
                ?>
            </select>
            <label for="patient_name">Patient Name:</label>
            <select name="patient_name" id="patient_name" required>
                <?php
                $abc = $conn->query("SELECT request_id, patient_name FROM blood_request");
                while ($row = $abc->fetch_assoc()) {
                    echo "<option value='{$row['patient_name']}'>{$row['patient_name']}</option>";
                }
                ?>
            </select>
            <label for="donation_date">Donation Date:</label>
            <input type="date" name="donation_date" id="donation_date" required>
            <label for="remarks">Remark</label>
            <input type="text" name="remarks" id="remarks">
            <label for="donation_image">Image</label>
            <input type="file" name="donation_image" id="donation_image" required>


            <input type="submit" value="Record Donation">
        </div>
    </form>

</div>