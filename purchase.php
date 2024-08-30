<?php
include 'config.php'; // Include the database connection

// Handle Purchase
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['purchase'])) {
    $id = $_POST['property-id'];
    $quantity = $_POST['quantity'];

    // Get current quantity
    $stmt = $mysqli->prepare("SELECT quantity FROM properties WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($current_quantity);
    $stmt->fetch();
    $stmt->close();

    if ($current_quantity >= $quantity) {
        // Reduce quantity
        $new_quantity = $current_quantity - $quantity;
        $stmt = $mysqli->prepare("UPDATE properties SET quantity=? WHERE id=?");
        $stmt->bind_param("ii", $new_quantity, $id);

        if ($stmt->execute()) {
            $message = "Purchase successful!";
        } else {
            $message = "Error during purchase: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Insufficient quantity available.";
    }
}

// Retrieve Properties
$result = $mysqli->query("SELECT * FROM properties");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Properties - Purchase</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Simple styles for the modal and form */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal input[type="text"],
        .modal input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
        }

        .modal button {
            width: 100%;
            padding: 10px;
            background-color: teal;
            color: white;
            border: none;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: darkcyan;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="#" id="loginBtn">Log In</a>
        </nav>
    </header>
    <main class="main">
        <section class="hero">
            <h1>Available Properties</h1>
            <p>Purchase properties here.</p>
        </section>
        <section class="content">
            <div class="crud-section">
                <h2>Properties List</h2>
                <?php if (isset($message)) echo "<p>$message</p>"; ?>
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Purchase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['address']}</td>
                                    <td>\${$row['price']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>
                                        <form action='purchase.php' method='post'>
                                            <input type='hidden' name='property-id' value='{$row['id']}'>
                                            <input type='number' name='quantity' value='1' min='1' max='{$row['quantity']}' required>
                                            <button type='submit' name='purchase'>Buy</button>
                                        </form>
                                    </td>
                                  </tr>";
                        }

                        $result->free();
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    <footer class="footer">
        <p>&copy; 2024 House Recruitment System</p>
    </footer>

    <!-- The Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Log In</h2>
            <form id="loginForm">
                <input type="text" id="username" placeholder="Username" required>
                <input type="password" id="password" placeholder="Password" required>
                <button type="submit">Log In</button>
            </form>
            <p id="loginError" style="color: red; display: none;">Invalid username or password.</p>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("loginModal");

        // Get the button that opens the modal
        var btn = document.getElementById("loginBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Handle login form submission
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();

            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "user" && password === "12345") {
                alert("Login successful!");
                window.location.href = "dashboard.php"; // Redirect to the dashboard page
            } else {
                document.getElementById("loginError").style.display = "block";
            }
        });
    </script>
</body>
</html>

<?php
$mysqli->close();
?>
