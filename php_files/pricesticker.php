<?php
// Initialize variables
$vehicles = [];

// Database connection
$host = "localhost";
$dbname = "friendlycardealership";
$username = "user1"; // Replace with your MySQL username
$password = "password123"; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Current date and time: " . date("Y-m-d H:i:s");
    $stmt = $conn->prepare("SELECT * FROM pricesticker");
    $stmt->execute();
    $vehicles = $stmt->fetchAll();

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Vehicles</title>
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
    <h1>All Available Vehicles</h1>
    <table>
        <thead>
            <tr>
                <th>Vehicle ID</th>
                <th>Model</th>
                <th>Color</th>
                <th>Capacity</th>
                <th>Doors</th>
                <th>Cylinders</th>
                <th>Other Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($vehicles as $v): ?>
            <tr>
                <td><?php echo $v['vehicleID']; ?></td>
                <td><?php echo $v['model']; ?></td>
                <td><?php echo $v['color']; ?></td>
                <td><?php echo $v['capacity']; ?></td>
                <td><?php echo $v['numDoors']; ?></td>
                <td><?php echo $v['numCylinders']; ?></td>
                <td><?php echo $v['otherOptions']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add a Back button -->
    <button onclick="window.location.href='db_index.php'">Back to Main Menu</button>
    <!-- Add a More Info button -->
    <button onclick="window.location.href='pricesticker_p2.php'">More Info</button>
</body>
</html>