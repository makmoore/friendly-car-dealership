<?php
// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1";
$password = "password123";

// Initialize a variable to store feedback messages
$message = "";

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle student insertion
    if (isset($_POST['new_customer'])) {
        $cus_firstname = $_POST['cus_firstname'];
        $cus_lastname = $_POST['cus_lastname'];
        $cus_phone = $_POST['cus_phone'];
        $cus_email = $_POST['cus_email'];
        $cus_street = $_POST['cus_street'];
        $cus_city = $_POST['cus_city'];
        $cus_state = $_POST['cus_state'];
        $cus_zip = $_POST['cus_zip'];
        $cus_notes = $_POST['cus_notes'];
        
        // Prepare SQL statement to insert student data
        $sql = "INSERT INTO customers (cusFirstName, cusLastName, cusPhone, cusEmail, street, city, state, zip, cusNotes)
        VALUES (:cus_firstname, :cus_lastname, :cus_phone, :cus_email, :cus_street, :cus_city, :cus_state, :cus_zip, :cus_notes)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cus_firstname', $cus_firstname);
        $stmt->bindParam(':cus_lastname', $cus_lastname);
        $stmt->bindParam(':cus_phone', $cus_phone);
        $stmt->bindParam(':cus_email', $cus_email);
        $stmt->bindParam(':cus_street', $cus_street);
        $stmt->bindParam(':cus_city', $cus_city);
        $stmt->bindParam(':cus_state', $cus_state);
        $stmt->bindParam(':cus_zip', $cus_zip);
        $stmt->bindParam(':cus_notes', $cus_notes);

        // Execute and provide feedback
        if ($stmt->execute()) {
            $message = "Customer added successfully!";
        } else {
            $message = "Error adding customer.";
        }
    }

} catch (PDOException $e) {
    // Display error if connection fails
    $message = "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        form {
            display: inline-block;
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: left;
        }
        h3 {
            margin-top: 0;
            text-align: center;
        }
        .message {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>New Customer</h1>
    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    
    <!-- Form to insert a new student -->
    <form method="post" action="new_customer.php">
        <h3>Add New Customer</h3>
        <label for="cus_firstname">First Name:</label>
        <input type="text" name="cus_firstname" id="cus_firstname" required><br><br>
        <label for="cus_lastname">Last Name:</label>
        <input type="text" name="cus_lastname" id="cus_lastname" required><br><br>
        <label for="cus_phone">Phone Number:</label>
        <input type="text" name="cus_phone" id="cus_phone" ><br><br>
        <label for="cus_email">Email:</label>
        <input type="text" name="cus_email" id="cus_email" ><br><br>
        <label for="cus_street">Street:</label>
        <input type="text" name="cus_street" id="cus_street" required><br><br>
        <label for="cus_city">City:</label>
        <input type="text" name="cus_city" id="cus_city" required><br><br>
        <label for="cus_state">State:</label>
        <input type="text" name="cus_state" id="cus_state" maxlength="2" pattern="[A-ZA-Z]{2}" size="2" required title="Please enter a capitalized two-letter state abbreviation. (Ex. TX)"><br><br>
        <label for="cus_zip">Zip Code:</label>
        <input type="text" name="cus_zip" id="cus_zip" size="10" required><br><br>
        <label for="cus_notes">Notes:</label>
        <input type="text" name="cus_notes" id="cus_notes" size="28"><br><br>
        <button type="submit" name="new_customer">Add Customer</button>
    </form>

    <!-- Button to go back to the main menu -->
    <br>
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
    <button onclick="window.location.href='customers.php'">View All Customers</button>
</body>
</html>
