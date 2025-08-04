//<?php
//include 'dbms connection.php';
//
//$request_id = $_POST['request_id'];
//$action = $_POST['action'];
//
//if ($action === 'approve') {
//    $status = 'approved';
//} elseif ($action === 'reject') {
//    $status = 'rejected';
//}
//
//$sql = "UPDATE blood_request SET status = ? WHERE request_id = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("si", $status, $request_id);
//$stmt->execute();
//
//header("Location: admin_review.php");
//?>
//

<?php
session_start();
require_once 'dbms connection.php';

// Ensure POST values exist and are safe
if (!isset($_POST['request_id'], $_POST['action'])) {
    die('Invalid request.');
}

$request_id = (int)$_POST['request_id'];
$action = $_POST['action'];

if (!in_array($action, ['approve', 'reject'])) {
    die('Invalid action.');
}

$status = ($action === 'approve') ? 'approved' : 'rejected';

// Prepare and bind
$sql = "UPDATE blood_request SET status = ? WHERE request_id = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    die('Server error. Try again later.');
}

$stmt->bind_param("si", $status, $request_id);
$stmt->execute();
$stmt->close();

// Optional: Log action to file (for traceability)
$log_entry = date('Y-m-d H:i:s') . " | Request $request_id marked as $status by admin\n";
file_put_contents('logs/admin_actions.log', $log_entry, FILE_APPEND);

// Redirect with feedback (optional: add query param like ?updated=success)
header("Location: admin_review.php");
exit;
?>