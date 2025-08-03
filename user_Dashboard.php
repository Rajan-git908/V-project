<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #e63946;
            --secondary: #457b9d;
            --light: #f1faee;
            --dark: #1d3557;
        }
        
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f8f9fa;
            color: #333;
        }
        
        nav {
            background-color: var(--dark);
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo img {
            height: 50px;
        }
        
        ul {
            display: flex;
            list-style: none;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }
        
        ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        ul li a:hover {
            color: var(--primary);
        }
        
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }
        
        .profile {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        
        .profile-body ul {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
            transition: background 0.3s;
        }
        
        button:hover {
            background: #c1121f;
        }
        
        .donation-container, 
        .do-history,
        .blood-requests,
        .resources {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        
        .do-head {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: var(--dark);
            border-bottom: 2px solid var(--primary);
            padding-bottom: 0.5rem;
        }
        
        .do-co-body {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        
        .do-co-body div {
            text-align: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .graph {
            grid-column: span 3;
            height: 300px;
        }
        
        .do-body {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        .donation-card {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary);
        }
        
        .request-card {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .tag {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            background: var(--secondary);
            color: white;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
        }
        
        .urgent {
            background: var(--primary);
        }
    </style>
<script src="main.js"></script>
</head>
<body data-user-id="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
<nav>
    <div class="header">
        <div class="logo">
            <img src="../Images/logo.jpg" alt="Blood donation system logo">
        </div>
        <ul>
            <li><a href="#dashboard">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#history">Donation History</a></li>
            <li><a href="#requests">Blood Requests</a></li>
            <li><a href="#resources">Resources</a></li>
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

    <div class="main-content">
        <section id="dashboard">
            <div class="donation-container">
                <div class="do-head">Your Donation Impact</div>
                <div class="do-co-body">
                    <div>
                        <h4>Total Donations</h4>
                        <h2 id="totalDonations">8</h2>
                    </div>
                    <div>
                        <h4>Lives Impacted</h4>
                        <h2 id="livesImpacted">24</h2>
                    </div>
                    <div>
                        <h4>Next Milestone</h4>
                        <h2 id="nextMilestone">10 Donations</h2>
                    </div>
                    <div class="graph">
                        <canvas id="donationChart"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <section id="history">
            <div class="do-history">
                <div class="do-head">Recent Donations</div>
                <div class="do-body" id="donationHistory">
                    <!-- Dynamic content will be inserted here -->
                </div>
            </div>
        </section>

        <section id="requests">
            <div class="blood-requests">
                <div class="do-head">Blood Requests Near You</div>
                <div id="requestsList">
                    <!-- Dynamic content will be inserted here -->
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

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal" style="display:none; position:fixed; z-index:100; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5)">
    <div style="background:white; margin:5% auto; padding:2rem; border-radius:8px; width:500px">
        <span style="float:right; cursor:pointer" onclick="closeModal()">&times;</span>
        <h2>Edit Profile</h2>
        <form id="editProfileForm">
            <div style="margin-bottom:1rem">
                <label style="display:block">Full Name</label>
                <input type="text" style="width:100%; padding:0.5rem" value="John Doe">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block">Email</label>
                <input type="email" style="width:100%; padding:0.5rem" value="john.doe@example.com">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block">Phone</label>
                <input type="tel" style="width:100%; padding:0.5rem" value="(555) 123-4567">
            </div>
            <div style="margin-bottom:1rem">
                <label style="display:block">Location</label>
                <input type="text" style="width:100%; padding:0.5rem" value="New York, USA">
            </div>
            <button type="submit" style="background:var(--primary); color:white; border:none; padding:0.5rem 1rem; border-radius:5px">Save Changes</button>
        </form>
    </div>
</div>

<script>


    // Sample data loading for donations
   

  
</script>
</body>
</html>
