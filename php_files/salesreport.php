<?php
// Initialize variables
$salesrep = [];

// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1"; // Replace with your MySQL username
$password = "password123"; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Current date and time: " . date("Y-m-d H:i:s");
    $stmt = $conn->prepare("SELECT * FROM salesreport");
    $stmt->execute();
    $salesrep = $stmt->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insurance & Tax Info</title>
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
    <h1>Sales Report Information</h1>
    <table>
        <thead>
            <tr>
                <th>Report ID #</th>
                <th>Commission Earned</th>
                <th>Report Frequency</th>
                <th>Sales Data</th>
                <th>Customer ID</th>
                <th>Bill of Sale ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($salesrep as $sr): ?>
            <tr>
                <td><?php echo $sr['ReportID']; ?></td>
                <td><?php echo '$' . number_format($sr['CommissionEarned'], 2); ?></td>
                <td><?php echo $sr['ReportFrequency']; ?></td>
                <td><?php echo $sr['SalesData']; ?></td>
                <td><?php echo $sr['cusID']; ?></td>
                <td><?php echo $sr['BillofSaleID']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add a Back button -->
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
</body>
</html>