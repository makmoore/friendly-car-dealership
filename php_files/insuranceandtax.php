<?php
// Initialize variables
$instax = [];

// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1"; // Replace with your MySQL username
$password = "password123"; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Current date and time: " . date("Y-m-d H:i:s");
    $stmt = $conn->prepare("SELECT * FROM insuranceandtax");
    $stmt->execute();
    $instax = $stmt->fetchAll();

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
    <h1>Insurance and Tax Information</h1>
    <table>
        <thead>
            <tr>
                <th>License Plate</th>
                <th>Date Released to Owner</th>
                <th>License Fee</th>
                <th>Proof of Insurance</th>
                <th>Bill of Sale ID</th>
                <th>State Sales Tax</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($instax as $iat): ?>
            <tr>
                <td><?php echo $iat['LPnum']; ?></td>
                <td><?php echo $iat['DateReleasedToOwner']; ?></td>
                <td><?php echo '$' . number_format($iat['LicenseFee'], 2); ?></td>
                <td><?php echo $iat['proofOfInsurance']; ?></td>
                <td><?php echo $iat['BillofSaleID']; ?></td>
                <td><?php echo $iat['StateSalesTax']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add a Back button -->
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
</body>
</html>