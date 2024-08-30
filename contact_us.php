<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - House Recruitment System</title>
    <link rel="stylesheet" href="style.css">
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="purchase.php">purchasep</a>
        </nav>
    </header>
    <main class="main">
        <section class="hero">
            <h1>Contact Us</h1>
            <p>We'd love to hear from you!</p>
        </section>
        <section class="content">
            <div class="system-description">
                <h2>Get in Touch</h2>
                <p>If you have any questions or need further information, please contact us through the following methods:</p>
                <p>Email: <a href="keliat@gmail.com">keliat@gmail.com</a></p>
                <p>Phone:000000</p>
                <p>KG 816</p>

                <h2>Contact Form</h2>
                <form action="contact_form_handler.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required></textarea>
                    <button type="submit">Send Message</button>
                </form>

                <!-- Social Media Icons below the form -->
                <div class="social-icons-form">
                    <h3>Follow Us</h3>
                    <a href="https://twitter.com" target="_blank" title="Follow us on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" title="Follow us on Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="mailto:support@example.com" title="Send us an email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 House Recruitment System</p>
    </footer>
</body>
</html>
