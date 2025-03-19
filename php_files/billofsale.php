<?php
// Initialize variables
$billofsales = [];

// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1"; // Replace with your MySQL username
$password = "password123"; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Current date and time: " . date("Y-m-d H:i:s");
    $stmt = $conn->prepare("SELECT * FROM billofsale");
    $stmt->execute();
    $billofsales = $stmt->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill of Sale Info</title>
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
    <h1>Bill of Sale Information</h1>
    <table>
        <thead>
            <tr>
                <th>Bill of Sale ID</th>
                <th>Vehicle ID</th>
                <th>Customer ID</th>
                <th>Salesperson</th>
                <th>Delivery Date</th>
                <th>Price</th>
                <th>New/Used</th>
                <th>Specifications</th>
                <th>Warranty Information</th>
                <th>Financing Information</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($billofsales as $bos): ?>
            <tr>
                <td><?php echo $bos['BillofSaleID']; ?></td>
                <td><?php echo $bos['vehicleID']; ?></td>
                <td><?php echo $bos['cusID']; ?></td>
                <td><?php echo $bos['SalespersonName']; ?></td>
                <td><?php echo $bos['Delivery']; ?></td>
                <td><?php echo '$' . number_format($bos['Price'], 2); ?></td>
                <td><?php echo $bos['NewOrUsed']; ?></td>
                <td><?php echo $bos['Specifications']; ?></td>
                <td><?php echo $bos['WarrantyInfo']; ?></td>
                <td><?php echo $bos['FinancingInfo']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add a Back button -->
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
</body>
</html>