<?php
include 'dbms connection.php';

$request_id = $_POST['request_id'];
$action = $_POST['action'];

if ($action === 'approve') {
    $status = 'approved';
} elseif ($action === 'reject') {
    $status = 'rejected';
}

$sql = "UPDATE blood_request SET status = ? WHERE request_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $request_id);
$stmt->execute();

header("Location: admin_review.php");
?>