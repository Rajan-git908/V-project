<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'dbms connection.php';

$user_id = $_SESSION['user_id'];

$summary_sql = "SELECT 
    COUNT(*) AS total,
    MAX(donation_date) AS last,
    DATE_ADD(MAX(donation_date), INTERVAL 90 DAY) AS next_eligible
FROM donation_history
WHERE donor_id = ?";
$summary_stmt = $conn->prepare($summary_sql);
$summary_stmt->bind_param("i", $user_id);
$summary_stmt->execute();
$summary_result = $summary_stmt->get_result();
$summary = $summary_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $receiver_id = $_POST['receiver_id'];
    $patient_name = $_POST['patient_name'];
    $blood_group = $_POST['blood_group'];
    $location = $_POST['location'];
    $date = $_POST['request_date'];

    $check_sql = "select user_id from members where user_id=?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("i", $receiver_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "Error: Invalid receiver ID.";
        exit;
    } else {

        $sql = "INSERT INTO blood_request (receiver_id,patient_name,blood_group,location,request_date) values ('$receiver_id','$patient_name','$blood_group','$location','$date')";
        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="Css/dashboard.css">
    <script src="main.js"></script>
</head>

<body data-user-id="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
    <nav>
        <div class="header">
            <div class="logo">
                <img src="/Blood transfusing/V-project/Images/logo.jpg" alt="Blood donation system logo">
            </div>
            <ul>
                <li><a href="#dashboard">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#history">Donation History</a></li>
                <li><a href="#Resouses">Resources</a></li>
                <li><a onclick="showRequestForm()">Blood Requests</a></li>
                <li><a href="logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="profile">
            <div class="profile-head">
                <h1 id='name'></h1>
            </div>
            <div class="profile-body">
                <ul> </ul>
                <button onclick="openEditModal()">Edit profile</button>
            </div>
        </div>
        
        <div id="requestForm" style="display: none;">
            <div class="container-form">
            <form action="user_Dashboard.php" method="post">
                <div class="form-body">
                <label for="receiver_id">Receiver Id:</label>
                <input type="number" name="receiver_id" id="receiver_id" required>
                <label for="patient_name">Patient_name</label>
                <input type="text" name="patient_name" id="patient_name" required>
                <label for="blood_group">Blood_Group:</label>
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
                <label for="location">Location</label>
                <input type="text" name="location" id="location" required>
                <label for="request_date">Date:</label>
                <input type="date" name="request_date" id="request_date" required>
                <button type="submit">Submit Request</button>
            </div></form>
        </div>
        </div>
        <div class="main-content">
            <section id="dashboard">
                <div class="donation-container">
                    <div class="do-head">Your Donation Impact</div>
                    <div class="do-co-body">
                        <div>
                            <h4>Total Donations</h4>
                            <h2 id="totalDonations"><?php echo $summary['total'] ?? 0; ?></h2>
                            <p>Last Donation: <?php echo $summary['last'] ?? 'N/A'; ?></p>
                            <p>Next Eligible Date: <?php echo $summary['next_eligible'] ?? 'N/A'; ?></p>
                        </div>

                    </div>
                </div>
            </section>

            <section id="history">
                <div class="do-history">
                    <div class="do-head">Recent Donations</div>
                    <div class="do-body" id="donationHistory">
                        <?php $history_sql = "SELECT donation_date, patient_name, blood_group, location FROM donation_history WHERE donor_id = ? ORDER BY donation_date DESC LIMIT 5";
                        $history_stmt = $conn->prepare($history_sql);
                        $history_stmt->bind_param("i", $user_id);
                        $history_stmt->execute();
                        $history_result = $history_stmt->get_result();

                        while ($row = $history_result->fetch_assoc()) {
                            echo "<div class='donation-record'>
            <strong>{$row['donation_date']}</strong> – 
            {$row['patient_name']} ({$row['blood_group']}) at {$row['location']}
          </div>";
                        }
                        ?>
                    </div>
                </div>
            </section>

            <section>
                <div class="blood-requests">
                    <div class="do-head">Blood Requests Near You</div>
                    <div id="requestsList">

                        <!-- adding function to show request -->

                    </div>
                </div>
            </section>

            <section id="resources">
                <div class="resources">
                    <div class="do-head">Educational Resources</div>
                    <div class="do-body">
                        <div class="donation-card">
                            <h3>Donation Process</h3>
                            <p>Learn what to expect before, during, and after your donation.</p>
                            <button>View Guide</button>
                        </div>
                        <div class="donation-card">
                            <h3>Eligibility Criteria</h3>
                            <p>Check if you qualify to donate blood based on health and travel history.</p>
                            <button>Check Eligibility</button>
                        </div>
                        <div class="donation-card">
                            <h3>Blood Types</h3>
                            <p>Understand how blood types compatibility works for transfusions.</p>
                            <button>Learn More</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>



    <script>
        function showRequestForm() {
            document.getElementById("requestForm").style.display = "block";
        }
    </script>

</body>

</html>