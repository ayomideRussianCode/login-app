<?php

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    //check if password and confirm  password match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match";
    } else {

        // check if username already exists
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $error = "Username already exists, Please choose another ";
        } else {

            //hash password  for security
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";

            if (mysqli_query($conn, $sql)) {
                echo "Data Inserted";
                header("Location:login.php");
            } else {
                $error =  "Something happened , no data inserted, error:" . mysqli_connect_error($conn);
            }
        }
    }
}
?>




<?php
include 'partials/header.php';
include  'partials/navigation.php';
?>



<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Create your Account</h2>

            <!-- Error message placeholder -->
            <?php if ($error): ?>

                <p style="color: red;">
                    <?php echo $error; ?>
                </p>
            <?php endif; ?>

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

<?php
include 'partials/footer.php';
?>



<!-- best practice - to make app work faster -->
<?php
mysqli_close($conn);
?>