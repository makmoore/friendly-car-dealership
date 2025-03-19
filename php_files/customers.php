<?php
// Initialize variables
$customers = [];

// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1"; // Replace with your MySQL username
$password = "password123"; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Current date and time: " . date("Y-m-d H:i:s");
    $stmt = $conn->prepare("SELECT * FROM customers");
    $stmt->execute();
    $customers = $stmt->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Customers</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
            z-index: 1;
        }
        tbody {
            display: block;
            max-height: 600px;
            overflow-y: auto;
        }
        thead, tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

    </style>
</head>
<body>
    <h1>All Customers</h1>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer): ?>
            <tr>
                <td><?php echo $customer['cusID']; ?></td>
                <td><?php echo $customer['cusFirstName']; ?></td>
                <td><?php echo $customer['cusLastName']; ?></td>
                <td><?php echo $customer['cusPhone']; ?></td>
                <td><?php echo $customer['cusEmail']; ?></td>
                <td><?php echo $customer['street'] . ', ' . $customer['city'] . ', ' . $customer['state'] . ' ' . $customer['zip']; ?></td>
                <td><?php echo $customer['cusNotes']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add a Back button -->
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
    <!-- Add a search button -->
    <button onclick="window.location.href='search_customers.php'">Search Customers</button>
    <button onclick="window.location.href='new_customer.php'">Add New Customer</button>
    <button onclick="window.location.href='remove_customerv2.php'">Remove Customer</button>
</body>
</html>