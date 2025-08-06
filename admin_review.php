<?php
include 'dbms connection.php';
session_start();

// Fetch pending requests
$sql = "SELECT * FROM blood_request WHERE status = 'pending'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin review</title>
    <link rel="stylesheet" href="Css/dashboard.css">
    <style>
        table.review-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table.review-table th, table.review-table td {
            border: 1px solid #ccc;
            padding: 0.75rem;
            text-align: center;
        }
        table.review-table th {
            background-color: #f8f8f8;
        }
        .action-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        .action-btn:hover {
            background-color: #0056b3;
        }
        .reject-btn {
            background-color: #dc3545;
        }
        .reject-btn:hover {
            background-color: #a71d2a;
        }
    </style>

</head>
<body>
  <section aria-label="Review Blood Request"> 

<h2>Pending Blood Requests</h2>

<?php if($result->num_rows>0): ?>
 <table class="review-table" aria-describedby="pendingRequests">
    <thead>
<tr>
    <th>Request ID</th>
    <th>Receiver Id </th>
<th>Patient Name</th>
<th>Blood Group</th>
<th>Location</th>
<th>Request Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['request_id']) ?></td>
        <td><?= htmlspecialchars($row['receiver_id']) ?></td>
        <td><?= htmlspecialchars($row['patient_name'])?></td>
        <td><?= htmlspecialchars($row['blood_group'])?></td>
        <td><?= htmlspecialchars($row['location'])?></td>
        <td><?= htmlspecialchars($row['request_date'])?></td>
        <td>
             <form method="POST" action="verify_request.php" onsubmit="return confirm('Are you sure?')">
                                    <input type="hidden" name="request_id" value="<?= (int)$row['request_id'] ?>">
                                    <button type="submit" name="action" value="approve" class="action-btn"> Approve</button>
                                    <button type="submit" name="action" value="reject" class="action-btn reject-btn"> Reject</button>
                                </form>

        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
</table>
<?php endif; ?>
</section> 
</body>
</html>