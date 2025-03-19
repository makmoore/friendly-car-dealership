<?php
// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1";
$password = "password123";

// Initialize message variable and customer info
$message = "";
$customer_info = null;

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Step 1: Display customer information by ID
    if (isset($_POST['find_customer_by_id'])) {
        $cus_id = $_POST['cus_id'];
        $sql = "SELECT * FROM customers WHERE cusID = :cus_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cus_id', $cus_id, PDO::PARAM_INT);
        $stmt->execute();
        $customer_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer_info) {
            $message = "Customer found. Please confirm deletion below.";
        } else {
            $message = "No customer found with ID $cus_id.";
        }
    }

    // Step 1: Display customer information by name
    if (isset($_POST['find_customer_by_name'])) {
        $cus_firstname = $_POST['cus_firstname'];
        $cus_lastname = $_POST['cus_lastname'];
        $sql = "SELECT * FROM customers WHERE cusFirstName = :cus_firstname AND cusLastName = :cus_lastname";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cus_firstname', $cus_firstname);
        $stmt->bindParam(':cus_lastname', $cus_lastname);
        $stmt->execute();
        $customer_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer_info) {
            $message = "Customer found. Please confirm deletion below.";
        } else {
            $message = "No customer found with the name $cus_firstname $cus_lastname.";
        }
    }

    // Step 2: Delete customer after confirmation
    if (isset($_POST['confirm_delete'])) {
        $cus_id = $_POST['cus_id'];
        $sql = "DELETE FROM customers WHERE cusID = :cus_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cus_id', $cus_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $message = "Customer with ID $cus_id deleted successfully.";
            $customer_info = null; // Clear customer info after deletion
        } else {
            $message = "Error deleting customer: " . $conn->errorInfo()[2];
        }
    }
} catch (PDOException $e) {
    $message = "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Customers</title>
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
        .error {
            color: red;
            font-weight: bold;
        }
        .customer-info {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: inline-block;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Delete Customers</h1>
    <p class="<?php echo $customer_info ? 'message' : 'error'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </p>

    <!-- Form to find customer by ID -->
    <?php if (!$customer_info): ?>
        <form method="post" action="remove_customerv2.php">
            <h3>Find Customer by ID</h3>
            <label for="cus_id">Customer ID:</label>
            <input type="number" name="cus_id" id="cus_id" required><br><br>
            <button type="submit" name="find_customer_by_id">Find Customer by ID</button>
        </form>

        <!-- Form to find customer by name -->
        <form method="post" action="remove_customerv2.php">
            <h3>Find Customer by Name</h3>
            <label for="cus_firstname">First Name:</label>
            <input type="text" name="cus_firstname" id="cus_firstname" required><br><br>
            <label for="cus_lastname">Last Name:</label>
            <input type="text" name="cus_lastname" id="cus_lastname" required><br><br>
            <button type="submit" name="find_customer_by_name">Find Customer by Name</button>
        </form>
    <?php endif; ?>

    <!-- Display customer info and confirm deletion -->
    <?php if ($customer_info): ?>
        <div class="customer-info">
            <h3>Customer Information</h3>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($customer_info['cusID']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($customer_info['cusFirstName']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($customer_info['cusLastName']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($customer_info['cusPhone']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($customer_info['cusEmail']); ?></p>
            <p><strong>Street:</strong> <?php echo htmlspecialchars($customer_info['street']); ?></p>
            <p><strong>City:</strong> <?php echo htmlspecialchars($customer_info['city']); ?></p>
            <p><strong>State:</strong> <?php echo htmlspecialchars($customer_info['state']); ?></p>
            <p><strong>Zip:</strong> <?php echo htmlspecialchars($customer_info['zip']); ?></p>
            <p><strong>Notes:</strong> <?php echo htmlspecialchars($customer_info['cusNotes']); ?></p>
        </div>
        <form method="post" action="remove_customerv2.php">
            <input type="hidden" name="cus_id" value="<?php echo htmlspecialchars($customer_info['cusID']); ?>">
            <button type="submit" name="confirm_delete">Confirm Delete</button>
        </form>
    <?php endif; ?>

    <br>
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
    <button onclick="window.location.href='customers.php'">View All Customers</button>
</body>
</html>
