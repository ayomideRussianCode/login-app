
<?php
include 'db.php';

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

}
        // check if username already exists
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql  );

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if(password_verify($password, $user['password'])) {

                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                header("Location: admin.php");
                exit;
            } else {
                $error = "Invalid password";
            }

        } else {
            $error = "user not found";
        }
        


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login">

<h2>Log In</h2>

<?php if ($error): ?>
    
    <p style="color: red;">
        <?php echo $error; ?>
    </p>
    <?php endif; ?>
   
    
    <nav>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
    
            <!-- When the user is logged in -->
            <li>
                <a href="admin.php">Admin</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
    
            <!-- When the user is not logged in -->
            <li>
                <a href="register.php">Register</a>
            </li>
            <li>
                <a href="login.php">Login</a>
            </li>
        </ul>
    </nav>
    

    <!-- Include Header and Navigation -->
    
    <div class="container">
        <div class="form-container">
            <form method="POST" action="">
                <h2>Login</h2>
    
                <!-- Error message placeholder -->
                <p style="color:red">
                    <!-- Error message goes here -->
                </p>
    
                <label for="username">Username:</label><br>
                <input type="text" name="username" required><br><br>
    
                <label for="password">Password:</label><br>
                <input type="password" name="password" required><br><br>
    
                <input type="submit" value="Login">
            </form>
        </div>
    </div>
    
    <!-- Include Footer -->

</body>
</html>


//best practice - to make app work faster
<?php 
mysqli_close($conn);
?>