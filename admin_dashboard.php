<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'dbms connection.php';
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="main.js"></script>

</head>

<body data-user-id="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

    <nav>
        <div class="header">
            <div class="logo"><img src="/Blood transfusing/V-project/Images/logo.jpg" alt="Missing image"></div>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="donate.php">Add Donation</a></li>
                <li><a href="logout.php">Log out</a></li>

            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="profile">
            <div class="profile-head">
                <h1 id="name"></h1>
            </div>
            <div class="profile-body">
                <ul></ul>
                <button>Edit profile</button>
            </div>
        </div>

        <?php
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
        ?>
        <div class="donation-container">
            <div class="do-head">Your donation Impact</div>
            <div class="do-co-body">
                <div>
                    <h4>Total Donations</h4>
                    <h2 id="totalDonations"><?php echo $summary['total'] ?? 0; ?></h2>
                </div>
                <div>
                    <h4>Last Donation</h4>
                    <h5> <?php echo $summary['last'] ?? 'N/A'; ?></h5>
                </div>
                <div>
                    <h4>Next Eligible Date </h4>
                    <h5> <?php echo $summary['next_eligible'] ?? 'N/A'; ?></h5>
                </div>
            </div>
         <div class="do-history">
            <div class="do-head">Recent Donations</div>
            <div class="do-body">
                <?php
                $history_sql = "SELECT patient_name, blood_group, donation_date, location FROM donation_history WHERE donor_id = ? ORDER BY donation_date DESC LIMIT 5";
                $history_stmt = $conn->prepare($history_sql);
                $history_stmt->bind_param("i", $user_id);
                $history_stmt->execute();
                $result = $history_stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<div class='donation-record'>
                             <table>
                            <thead>
                                <th>Dontion_date
                                <th>Patient_name
                                <th>Blood_Group
                            </thead>
                        
          <tbody><tr><td>  {$row['donation_date']}</td>
          <td> {$row['patient_name']}</td><td> ({$row['blood_group']})</td>
          </tr></tbody></table></div>";
                }

                $update = $conn->prepare("UPDATE blood_request SET status = 'fulfilled' WHERE request_id = ?");
                $update->bind_param("i", $request_id);
                $update->execute();
                ?>
            </div>
        </div>   
        </div>

        

    </div>

    
    <section>



        <iframe src="admin_review.php" width="100%" height="600px" style="border:none;"></iframe>
        <div class="card">

        </div>
    </section>



</body>

</html>