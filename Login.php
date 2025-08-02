<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Css/style.css">
</head>
<body>
    <div class="container-form">
        <form action="Login.php" method="post">
            <div class="form-header">Welcome to Login</div>
            <div class="form-body">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <label for="password">Enter Password</label>
                <input type="password" name="password" id="password">
                <button type="submit" name="submit">Log In</button>
                <a href="">Forget password</a>
                <a href="signup.php">You don't have Member</a>
                
            </div>
        </form>

    </div>
</body>
</html>