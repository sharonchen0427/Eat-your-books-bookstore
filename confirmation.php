<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Confirmation</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/confirmation.css"/>
</head>
<body>

<?php

include('header.php');
if(!empty($_SESSION["cart_item"])) {
    unset($_SESSION["cart_item"]);
    session_destroy();
}

?>

<main>
    <h1>Thank you for your order.  Have a great day!</h1>
    <p><a href='index.php' class='commandButton'>Return to Home</a></p>


    <table class="database">
        <tr>
            <th>Order Id</th>
            <th>Customer Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Credit Card</th>
        </tr>

        <?php
        // Retrieve data from the database,
        $db = new mysqli('127.0.0.1', 'root', '88', 'bookstore');
        $query = "SELECT orderId, customerName,address,phone,email,creditCard FROM bookstore.order";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($orders as $order) {

            echo "<td> ".$order["orderId"]." </td>";
            echo "<td> ".$order["customerName"]." </td>";
            echo "<td> ".$order["address"]." </td>";
            echo "<td> ".$order["phone"]." </td>";
            echo "<td> ".$order["email"]." </td>";
            echo "<td> ".$order["creditCard"]." </td>";
            echo "<tr>";
        }

        ?>
    </table>
</main>
<?php
include('footer.php');
?>
</body>
</html>
