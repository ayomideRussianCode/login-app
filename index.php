<?php
include 'partials/header.php';
include  'partials/navigation.php';
?>
<div class="container">
        <div class="hero">
                <div class="hero-content">
                        <h2>Welcome to our PHP login APP</h2>
                        <p>Securely login and manage your account with us</p>
                        <div class="hero-buttons">
                                <?php if (!is_user_logged_in()) : ?>
                                        <a class="btn" href="login.php" Login>Login</a>
                                        <a class="btn" href="register.php" Login>Register</a>
                                <?php endif; ?>
 
                        </div>
                </div>
        </div>
</div>

<?php
include 'partials/footer.php';
?>