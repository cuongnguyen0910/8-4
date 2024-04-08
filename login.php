<!DOCTYPE html>
<html lang="en">
<?php 
    $title = "Log in";
    include_once('head.inc');
?>
<body>
    <?php include_once('header.inc');?>
    <!-- Login form -->
    <div class="login">
    <h1>Login</h1>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
    <form action="" method="post" class="login-form">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>

    <!-- PHP function to login -->
    <?php
        session_start();

        // Check if the user is already logged in, if yes, redirect to manage.php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            header("Location: manage.php");
            exit;
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check username and password (You'll need to replace these with your actual authentication mechanism)
            $username = "admin"; // Sample username
            $password = "password"; // Sample password

            if ($_POST['username'] === $username && $_POST['password'] === $password) {
                // Authentication successful, set session variables
                $_SESSION['loggedin'] = true;

                // Redirect to manage.php
                header("Location: manage.php");
                exit;
            } else {
                // Authentication failed
                $error = "Invalid username or password";
            }
        }
    ?>
    </div>
    <?php include_once('footer.inc'); ?>
</body>
</html>