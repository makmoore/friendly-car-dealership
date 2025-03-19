<?php
// Initialize an empty array to hold the customers' information
$customers = [];
$message = "";

// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1";
$password = "password123";

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if search was submitted
    if (isset($_POST['search_by_name']) && (!empty($_POST['firstNameVal']) || !empty($_POST['lastNameVal']) || !empty($_POST['idVal']))) {
        $firstName = ($_POST['firstNameVal'] ?? "") . "%";  // Use wildcard for partial match
        $lastName = ($_POST['lastNameVal'] ?? "") . "%";    // Use wildcard for partial match
        $cusID = "%" . $_POST['idVal'] . "%";  // Use wildcard for partial match

        // Build the dynamic SQL query
        $conditions = [];
        if (!empty($_POST['firstNameVal'])) {
            $conditions[] = "cusFirstName LIKE :firstName";
        }
        if (!empty($_POST['lastNameVal'])) {
            $conditions[] = "cusLastName LIKE :lastName";
        }
        if (!empty($_POST['idVal'])) {
            $conditions[] = "cusID LIKE :cusID";
        }

        $sql = "SELECT * FROM customers";
        if ($conditions) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $stmt = $conn->prepare($sql);

        // Bind parameters dynamically
        if (!empty($_POST['firstNameVal'])) {
            $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        }
        if (!empty($_POST['lastNameVal'])) {
            $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        }
        if (!empty($_POST['idVal'])) {
            $stmt->bindParam(':cusID', $cusID, PDO::PARAM_STR);
        }

        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($customers)) {
            $message = "No customers found with the provided search criteria.";
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
    <title>Search Customers</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin: 20px;
        }

        input, button {
            padding: 10px;
            font-size: 12px;
            width: 20%;
            max-width: 400px;

        }
        label {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Search Customers</h1>

    <!-- Search for first name, last name, and customer ID -->
    <form method="POST" action="search_customers.php">
        <label for="idVal">Enter Customer ID:</label>
        <input type="text" name="idVal" id="idVal" placeholder="Customer ID">

        <label for="firstNameVal">Enter First Name:</label>
        <input type="text" name="firstNameVal" id="firstNameVal" placeholder="First Name">

        <label for="lastNameVal">Enter Last Name:</label>
        <input type="text" name="lastNameVal" id="lastNameVal" placeholder="Last Name">

        <button type="submit" name="search_by_name">Search</button>
    </form>

    <h2>Search Results</h2>
    <?php if (!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <ul>
        <?php foreach ($customers as $cus): ?>
            <li>
                <!-- Can change this to look however you want -->
                <?php echo htmlspecialchars($cus['cusID']) . " --- " . htmlspecialchars($cus['cusFirstName']) . " " . htmlspecialchars($cus['cusLastName']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Button to go back to show all customers -->
    <button onclick="window.location.href='customers.php'">Show All Customers</button>
    <!-- Button to go back to the main menu -->
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
</body>
</html>
