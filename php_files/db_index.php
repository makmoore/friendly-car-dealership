<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Friendly Car Dealership</title>
        <!-- used https://coolors.co/ to pick a color for the buttons but we can make it anything -->
        <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h1 {
            margin-top: 20px;
        }
        .button-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }
        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #517B62;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button-container a:hover {
            background-color: #385644;
        }
    </style>
</head>
<body>
    <h1>Welcome to Friendly Car Dealership</h1>
    <!-- First row of buttons ||| These are for showing the whole tables -->
    <div class="button-container">
        <a href="customers.php">Show All Customers</a>
        <a href="pricesticker.php">Show All Vehicles</a>
        <a href="billofsale.php">Bill of Sale Info</a>
        <a href="insuranceandtax.php">Insurance and Tax Info</a>
        <a href="salesreport.php">Sale Reports</a>
        <a href="survey.php">Surveys</a>
    </div>

    <!-- Second row of buttons ||| These can be for searching/sorting -->
    <!-- I did the customer search just to test it out but feel free to make any changes -->
    <div class="button-container">
        <a href="search_customers.php">Search Customers</a>
    </div>

    <!-- Third row of buttons? ||| Maybe for Inserting/Deleting or specific views or something? -->
    <div class="button-container">
        <a href="new_customer.php">Add New Customer</a>
        <a href="remove_customerv2.php">Remove Customer</a>
    </div>

</body>
</html>
