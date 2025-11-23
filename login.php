<?php
include 'partials/header.php';
include  'partials/navigation.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // check if username already exists
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: admin.php");
            exit;
        } else {
            $error = "Invalid password";
        }
    } else {
        $error = "user not found";
    }
}

?>


<!-- Include Header and Navigation -->

<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Login</h2>

            <?php if ($error): ?>

                <!-- Error message placeholder -->
                <p style="color:red">
                    <!-- Error message goes here -->
                    <?php echo $error; ?>

                </p>
            <?php endif; ?>


            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login">
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