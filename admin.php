<?php

include 'partials/header.php';
include 'partials/navigation.php';


if (!is_user_logged_in()) {
        redirect('login.php');
}

$result = mysqli_query($conn, "SELECT id, username, email, reg_date FROM users");

var_dump($result);
?>


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

<h1>Manage Users</h1>

<div class="container">
        <table class="user-table">
                <thead>
                        <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Registration Date</th>
                                <th>Actions</th>
                        </tr>
                </thead>
                <tbody>
                        <!-- fetching records from db -->
                        <?php while ($user = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                        <td><?php echo $user['id']; ?></td>
                                        <td><?php echo $user['username']; ?></td>
                                        <td><?php echo $user['email']; ?></td>
                                        <td><?php echo full_month_date($user['reg_date']); ?></td>
                                        <td>
                                                <form method="POST" style="display:inline-block;">
                                                        <input type="hidden" name="user_id" value="1">
                                                        <input type="email" name="email" value="john@example.com" required>
                                                        <button class="edit" type="submit" name="edit_user">Edit</button>
                                                </form>
                                                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                        <input type="hidden" name="user_id" value="1">
                                                        <button class="delete" type="submit" name="delete_user">Delete</button>
                                                </form>
                                        </td>
                                </tr>
                        <?php endwhile; ?>
                        <!-- Additional user rows can go here -->
                </tbody>
        </table>
</div>

<!-- Include Footer -->
<?php
mysqli_close($conn);
?>