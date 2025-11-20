<?php
include 'db.php';

$error = '';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    //check if password and confirm  password match
    if($password !== $confirm_password){
        $error = "Passwords do not match";
    } else{

        // check if username already exists
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql  );

        if(mysqli_num_rows($result) == 1){
            $error = "Username already exists, Please choose another ";
        } else{

            //hash password  for security
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";

    if ( mysqli_query($conn, $sql)) {
         echo "Data Inserted";
       }else {
         $error =  "Something happened , no data inserted, error:" .mysqli_connect_error($conn);
       }
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


<h2>Register</h2>

<?php if ($error): ?>
    
    <p style="color: red;">
        <?php echo $error; ?>
    </p>
    <?php endif; ?>



<body class="register">
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


//best practice - to make app work faster
<?php 
mysqli_close($conn);
?>