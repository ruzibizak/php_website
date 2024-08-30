<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - House Recruitment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="purchase.php">Purchase</a>
        </nav>
    </header>
    <main class="main">
        <section class="hero">
            <h1>Welcome to the House Recruitment System</h1>
            <p>Find your dream house with ease.</p>
        </section>
        <section class="content">
            <div class="system-description">
                <h2>About Our System</h2>
                <p>Our House Recruitment System is designed to simplify your search for the perfect home. With an intuitive interface and comprehensive property listings, you can easily find houses that match your needs and preferences. Our system offers detailed property descriptions, high-quality images, and easy navigation to help you make informed decisions.</p>
                <p>Whether you're looking for a cozy apartment or a luxurious villa, our system provides all the information you need to find your dream home. Explore our featured properties below and start your journey to finding the perfect place to live.</p>
            </div>
            <button class="toggle-button" onclick="toggleContent()">Show/Hide Featured Properties</button>
            <div id="toggleDiv" class="hidden">
                <h2>Featured Properties</h2>
                <div class="property-container">
                    <div class="property-card">
                        <img src="images/family-home.jpeg" alt="Beautiful Family Home" class="property-image">
                        <h3>Beautiful Family Home</h3>
                        <p>$350,000</p>
                        <p>Located in a quiet neighborhood with excellent schools nearby.</p>
                    </div>
                    <div class="property-card">
                        <img src="images/modern-apartment.jpeg" alt="Modern Apartment" class="property-image">
                        <h3>Modern Apartment</h3>
                        <p>$250,000</p>
                        <p>Conveniently located with modern amenities and easy access to the city.</p>
                    </div>
                    <div class="property-card">
                        <img src="images/luxurious-villa.jpeg" alt="Luxurious Villa" class="property-image">
                        <h3>Luxurious Villa</h3>
                        <p>$1,200,000</p>
                        <p>Spacious villa with a private pool and stunning views.</p>
                    </div>
                    <div class="property-card">
                        <img src="images/cozy-cottage.jpeg" alt="Cozy Cottage" class="property-image">
                        <h3>Cozy Cottage</h3>
                        <p>$180,000</p>
                        <p>Charming cottage with a beautiful garden and peaceful surroundings.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 House Recruitment System</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
