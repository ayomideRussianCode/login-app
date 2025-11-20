<?php
include 'db.php';

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if($password !== $confirm_password){
        $error = "Passwords do not match";
    } else{
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

       if ( mysqli_query($conn, $sql)) {
        echo "Data inserted";
       }else {
        echo "Something happened , no data insereted, error:" .mysqli_connect_error($conn);
       }
    }


}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="register">
    <nav>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
    
            <!-- When the user is logged in -->
            <li>
                <a href="admin.html">Admin</a>
            </li>
            <li>
                <a href="logout.html">Logout</a>
            </li>
    
            <!-- When the user is not logged in -->
            <li>
                <a href="register.html">Register</a>
            </li>
            <li>
                <a href="login.html">Login</a>
            </li>
        </ul>
    </nav>
    
<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Create your Account</h2>

            <!-- Error message placeholder -->
            <p style="color:red">
                <!-- Error message goes here -->
            </p>

            <label for="username">Username:</label>
            <input placeholder="Enter your username" type="text" name="username" required>
            <br>
            <br>


            <label for="email">Email:</label>
            <input placeholder="Enter your email" type="email" name="email" required>
            <br>
            <br>


            <label for="password">Password:</label>
            <input placeholder="Enter your password" type="password" name="password" required>
            <br>
            <br>


            <label for="confirm_password">Confirm Password:</label>
            <input placeholder="Confirm your password" type="password" name="confirm_password" required>
            <br>
            <br>


            <input type="submit" value="Register">
        </form>
    </div>
</div>
    
</body>
</html>

<!-- Include Footer -->