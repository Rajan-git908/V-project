

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="Css/dashboard.css">
</head>
<body data-user-id="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">

<nav>
    <div class="header">
        <div class="logo">
            <img src="../V-project/Images/logo.jpg" alt="missing image">
        </div>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="logout.php">Log out</a></li>
        </ul>
    </div>
</nav>

<div class="profile">
    <div class="profile-head">
        <h1 id="name"></h1>
    </div>
    <div class="profile-body">
        <ul></ul>
        <button>Edit profile</button>
    </div>
</div>

<div class="donation-container">
    <div class="do-head">Your donation Impact</div>
    <div class="do-co-body">
        <div>
            <h4>Total Donations</h4>
            <h2 id="count"></h2>
        </div>
        <div>
            <h4>Lives Impacted</h4>
            <h2 id="count1"></h2>
        </div>
        <div>
            <h4>Next Milestone</h4>
            <h2 id="count2"></h2>
        </div>
        <div class="graph"></div>
    </div>
</div>

<div class="do-history">
    <div class="do-head">Recent Donations</div>
    <div class="do-body">
        <!-- Future dynamic donations -->
    </div>
</div>

<script src="main.js">
</script>

</body>
</html>