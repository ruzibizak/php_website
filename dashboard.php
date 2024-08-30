<?php
include 'config.php'; // Ensure this file contains the database connection code

// Initialize message variables
$message = '';
$messageType = '';

// Function to add a property
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add') {
    $name = $_POST['property-name'];
    $address = $_POST['property-address'];
    $price = $_POST['property-price'];
    $quantity = $_POST['property-quantity']; // Added quantity

    $stmt = $mysqli->prepare("INSERT INTO properties (name, address, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $address, $price, $quantity);

    if ($stmt->execute()) {
        $message = "Property added successfully.";
        $messageType = "success";
    } else {
        $message = "Error adding property: " . $stmt->error;
        $messageType = "error";
    }

    $stmt->close();
}

// Function to delete a property
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $mysqli->prepare("DELETE FROM properties WHERE id=?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Property deleted successfully.";
        $messageType = "success";
    } else {
        $message = "Error deleting property: " . $stmt->error;
        $messageType = "error";
    }

    $stmt->close();
}

// Function to update a property
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['property-id'];
    $name = $_POST['property-name'];
    $address = $_POST['property-address'];
    $price = $_POST['property-price'];
    $quantity = $_POST['property-quantity']; // Added quantity

    $stmt = $mysqli->prepare("UPDATE properties SET name=?, address=?, price=?, quantity=? WHERE id=?");
    $stmt->bind_param("sssii", $name, $address, $price, $quantity, $id);

    if ($stmt->execute()) {
        $message = "Property updated successfully.";
        $messageType = "success";
    } else {
        $message = "Error updating property: " . $stmt->error;
        $messageType = "error";
    }

    $stmt->close();
}

// Fetch contact messages
$messages = [];
$messagesResult = $mysqli->query("SELECT * FROM messages");
if ($messagesResult) {
    while ($row = $messagesResult->fetch_assoc()) {
        $messages[] = $row;
    }
    $messagesResult->free();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - House Recruitment System</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dialog {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .dialog.success {
            border-color: green;
        }
        .dialog.error {
            border-color: red;
        }
        .contact-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .contact-table th, .contact-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .contact-table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact_us.php">Contact Us</a>
            <a href="dashboard.php">Dashboard</a>
        </nav>
    </header>
    <main class="main">
        <section class="hero">
            <h1>Dashboard</h1>
            <p>Manage your houses and properties here.</p>
        </section>
        <section class="content">
            <!-- Create New Item Form -->
            <div class="crud-section">
                <h2>Add New Property</h2>
                <form action="dashboard.php" method="post">
                    <input type="hidden" name="action" value="add">
                    <label for="property-name">Property Name:</label>
                    <input type="text" id="property-name" name="property-name" required>
                    <label for="property-address">Address:</label>
                    <input type="text" id="property-address" name="property-address" required>
                    <label for="property-price">Price:</label>
                    <input type="number" id="property-price" name="property-price" required>
                    <label for="property-quantity">Quantity:</label>
                    <input type="number" id="property-quantity" name="property-quantity" required>
                    <button type="submit" class="toggle-button">Add Property</button>
                </form>
            </div>

            <!-- List of Properties -->
            <div class="crud-section">
                <h2>Properties List</h2>
                <table class="crud-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $mysqli->query("SELECT * FROM properties");

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['address']}</td>
                                    <td>\${$row['price']}</td>
                                    <td>{$row['quantity']}</td>
                                    <td>
                                        <a href='dashboard.php?action=edit&id={$row['id']}' class='btn'>Edit</a>
                                        <a href='dashboard.php?action=delete&id={$row['id']}' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this property?\");'>Delete</a>
                                    </td>
                                  </tr>";
                        }

                        $result->free();
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Edit Property Form -->
            <?php
            if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
                $id = $_GET['id'];
                $result = $mysqli->query("SELECT * FROM properties WHERE id=$id");
                $property = $result->fetch_assoc();
            ?>
            <div class="crud-section">
                <h2>Edit Property</h2>
                <form action="dashboard.php" method="post">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="property-id" value="<?php echo $property['id']; ?>">
                    <label for="property-name">Property Name:</label>
                    <input type="text" id="property-name" name="property-name" value="<?php echo $property['name']; ?>" required>
                    <label for="property-address">Address:</label>
                    <input type="text" id="property-address" name="property-address" value="<?php echo $property['address']; ?>" required>
                    <label for="property-price">Price:</label>
                    <input type="number" id="property-price" name="property-price" value="<?php echo $property['price']; ?>" required>
                    <label for="property-quantity">Quantity:</label>
                    <input type="number" id="property-quantity" name="property-quantity" value="<?php echo $property['quantity']; ?>" required>
                    <button type="submit" class="toggle-button">Update Property</button>
                </form>
            </div>
            <?php
            }
            ?>

            <!-- Contact Messages -->
            <div class="crud-section">
                <h2>Contact Messages</h2>
                <table class="contact-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($messages as $message) {
                            echo "<tr>
                                    <td>{$message['id']}</td>
                                    <td>{$message['message']}</td>
                                    <td>{$message['created_at']}</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
