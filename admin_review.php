<?php
include 'dbms connection.php';
session_start();

// Fetch pending requests
$sql = "SELECT * FROM blood_request WHERE status = 'pending'";
$result = $conn->query($sql);

echo "<h2>Pending Blood Requests</h2>";
echo "<table border='1'>
<tr><th>Request ID</th><th>Patient Name</th><th>Blood Group</th><th>Location</th><th>Date</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['request_id']}</td>
        <td>{$row['patient_name']}</td>
        <td>{$row['blood_group']}</td>
        <td>{$row['location']}</td>
        <td>{$row['request_date']}</td>
        <td>
            <form method='POST' action='verify_request.php'>
                <input type='hidden' name='request_id' value='{$row['request_id']}'>
                <button name='action' value='approve'>Approve</button>
                <button name='action' value='reject'>Reject</button>
            </form>
        </td>
    </tr>";
}
echo "</table>";
?>