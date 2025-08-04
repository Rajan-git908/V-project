<?php
session_start();
include 'dbms connection.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT MONTH(donation_date) AS month, COUNT(*) AS total 
        FROM donation_history 
        WHERE user_id = ? 
        GROUP BY MONTH(donation_date) 
        ORDER BY month";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = array_fill(0, 12, 0); 

while ($row = $result->fetch_assoc()) {
    $monthIndex = (int)$row['month'] - 1;
    $data[$monthIndex] = (int)$row['total'];
}

echo json_encode($data);
?>