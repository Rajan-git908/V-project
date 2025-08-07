<?php
$user=0;
include 'dbms connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $sql = "SELECT user_id, password, role, Email FROM members WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'] )){
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role'] = $row['role'];
            header("Location: dashboard.php");
            exit();
        } else {
            $user = 1; // Invalid credentials
        }
    } else {
        $user = 1; // No user found
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Css/style.css">
</head>
<body>
    <nav>
    <div class="container">
        <div class="logo"><img src="Images/logo.jpg" alt="missing image"></div>
         <ul class="navlink">
         <li><a href="Index.html">Home</a></li>  
         <li><a href="About">About Us</a></li>
         <li><a href="Contact">Contact</a></li>
         <button onclick="location.href='signup.php'">Register</button>
         
         </ul>
        </div>
    </nav>
     <?php
    if($user){
     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Error! Invalid credentials</strong>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
     ?>
    <div class="container-form">
        <form action="Login.php" method="post">
            <div class="form-header">Welcome to Login</div>
            <div class="form-body">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <button type="submit" name="submit">Log In</button>
                <a href="">Forget password</a>
                <a href="signup.php">Not a Member yet? Register here</a>
                
            </div>
        </form>

    </div>

    <?php include '../V-project/Include/footer.php' ?>
</body>
</html>
