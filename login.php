<?php
session_start();
include 'config.php'; // Ensure this file contains the database connection code

// Function to handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple authentication logic
    // For production, use hashed passwords and secure methods
    if ($username === 'user' && $password === '20031') {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");
        exit();
    } else {
        $loginError = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - House Recruitment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="login.php">Login</a>
        </nav>
    </header>
    <main class="main">
        <section class="hero">
            <h1>Login</h1>
            <form action="login.php" method="post">
                <input type="hidden" name="action" value="login">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="toggle-button">Login</button>
                <?php if (isset($loginError)) echo "<p class='error'>$loginError</p>"; ?>
            </form>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 House Recruitment System</p>
    </footer>
</body>
</html>
