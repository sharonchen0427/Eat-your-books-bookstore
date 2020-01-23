<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Checkout</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/checkout.css"/>

</head>
<body>

<?php

include('header.php');
?>
<main>

    <section id="topSection">
        <h1>Checkout</h1>
    </section>

    <section id="bottomSection">
        <section id="dataForm">
            <p id="formTitleText">In order to purchase the items in your shopping cart, please provide the
                following information:</p>
            <div id="checkoutFormErrors">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $php_errormsg = 0;
                    if ($_POST['customerName'] == '') {
                        echo "<p>You must enter a customer name</p>";
                        $php_errormsg++;
                    }

                    if ($_POST['address'] == '') {
                        echo "<p>You must enter an address</p>";
                        $php_errormsg++;
                    }

                    if ($_POST['phone'] == '') {
                        echo "<p>You must enter a phone number</p>";
                        $php_errormsg++;
                    } elseif (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", ($_POST['phone']))) {
                        echo "<p>Phone Number should be XXX-XXX-XXXX</p>";
                        $php_errormsg++;
                    }

                    if ($_POST['email'] == '') {
                        echo "<p>You must enter an email</p>";
                        $php_errormsg++;
                    }

                    if ($_POST['creditCard'] == '') {
                        echo "<p>You must enter a credit card number</p>";
                        $php_errormsg++;
                    } elseif (!is_numeric($_POST['creditCard']) || strlen($_POST['creditCard']) < 16 || strlen($_POST['creditCard'])> 19){
                        echo "<p>CC number must be 16 to 19 numbers</p>";
                    $php_errormsg++;
                    }

                    if ($_POST['expMonth'] == 0 || $_POST['expYear'] == 0) {
                        echo "<p>You must select an Exp. Date</p>";
                        $php_errormsg++;
                    }

                    if (!$php_errormsg) {
                        header('Location: confirmation.php');
                        exit;
                    }
                }
                ?>
            </div>


            <!-- Create a form for customer information -->

            <section>

                <form id="checkoutForm" action="checkout.php" method="post">
                    <label for="customerName">Customer Name</label>
                    <input id="customerName" name="customerName" type="text" placeholder="First Name,Last Name"
                           autofocus="autofocus"
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "value ='" .$_POST['customerName']."'"; ?>>

                    <label for="address">Address</label>
                    <input id="address" name="address" type="text" placeholder="Street,City,State,Zipcode"
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "value ='" .$_POST['address']."'"; ?>>

                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="text" placeholder="XXX-XXX-XXXX"
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "value ='" .$_POST['phone']."'"; ?>>

                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Enter Your Email Address"
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "value ='" .$_POST['email']."'"; ?>>

                    <label for="creditCard">Credit Card Number</label>
                    <input id="creditCard" name="creditCard" type="text" placeholder="16-19 digits"
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "value ='" .$_POST['creditCard']."'"; ?>>

                    <label for="email">Exp. Date</label>
                    <div>
                        <select name="expMonth">
                            <option value="0">Select</option>
                            <?php
                            $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July',
                            'August', 'September', 'October', 'November', 'December');
                            for ($i = 1; $i <= 12; $i++) {
                            echo "<option value =" . $i;
                            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                                if ($_POST['expMonth'] == $i) {
                                    echo " selected";
                                }
                            }
                            echo ">" . $months[$i - 1] . "</option>";
                            }
                            ?>
                        </select>

                        <select name="expYear">
                            <option value="0">Select</option>
                            <?php
                            for ($i = 2020; $i <= 2029; $i++) {
                            echo "<option value =" . $i;
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if ($_POST['expYear'] == $i) {
                                    echo " selected";
                                }
                            }
                            echo ">" . $i . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input id="submitButton" type="submit" name="submit" value="submit" id="formSubmit">
                </form>

            </section>

        </section>
        <section id="checkoutSummary">
            <ul>
                <li>Next day delivery is guaranteed.</li>
                <li>A $5.00 shipping fee is applied to all orders</li>
            </ul>
            <div id="checkoutTotals">
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td>

                            <?php
                            if(isset($_SESSION['cart_item'])){
                                $total_quantity = 0;
                                $subtotal_price = 0;
                                foreach ($_SESSION["cart_item"] as $item) {
                                    $subtotal_price += ($item["price"]*$item["quantity"]);
                                }
                                echo"$".$subtotal_price."";
                            }
                            ?>

                        </td>


                    </tr>
                    <tr>
                        <td>Shipping Fee</td>
                        <td>
                            <?php
                            $shipping_fee=5.00;
                            echo"$".$shipping_fee."";
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="total">Total</td>
                        <td class="total">
                            <?php
                            if(!isset($_SESSION['cart_item'])){
                                $subtotal_price=0;
                                echo '<script>alert("There is nothing to check out. Get some yummy books!")</script>';
                                echo '<script>window.location="index.php"</script>';
                            }
                            $total_price=$subtotal_price+$shipping_fee;
                            echo"$".$total_price."";
                            ?>
                            
                            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo "value ='" .$total_price."'"; ?>>
                        </td>
                    </tr>
                </table>
            </div>
        </section>
    </section>


    <?php
    $db = new mysqli('127.0.0.1', 'root', '88', 'bookstore');
    $php_errormsg=0;
    if(!$php_errormsg){
        $query = "INSERT INTO `bookstore`.`order`( `orderId`,`customerName`,`address`,  `phone`, `email`, `creditCard`) VALUES (null,?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param('sssss',$_POST['customerName'],$_POST['address'], $_POST['phone'], $_POST['email'],$_POST['creditCard']);
        $stmt->execute();
    }

    ?>


</main>
<?php
include('footer.php')
?>
</body>
</html>

