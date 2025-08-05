<?php
include 'db_connection.php'; // Your DB config

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
        echo " Donation recorded successfully.";
        // You may want to update request status too!
    } else {
        echo " Error: " . $stmt->error;
    }
}
?>