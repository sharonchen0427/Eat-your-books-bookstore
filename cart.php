<?php
include('header.php');
require_once("dbcontroller.php");
$db_handle = new DBController();

?>
<?php
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":
            if(!empty($_POST["quantity"])) {
                $productBybookId = $db_handle->runQuery("SELECT * FROM book WHERE bookId='" . $_GET["bookId"] . "'");
                $itemArray = array($productBybookId[0]["bookId"]=>array('name'=>$productBybookId[0]["name"], 'bookId'=>$productBybookId[0]["bookId"], 'quantity'=>$_POST["quantity"], 'price'=>$productBybookId[0]["price"], 'image'=>$productBybookId[0]["image"]));

                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productBybookId[0]["bookId"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productBybookId[0]["bookId"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                        }
                    } else {
                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            echo '<script>window.location="cart.php"</script>';
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["bookId"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            echo '<script>window.location="cart.php"</script>';
            break;

        case "empty":
            unset($_SESSION["cart_item"]);
            session_destroy();
//            echo '<script>alert("Your cart is empty now. Explore more delicious books!")</script>';
            echo '<script>window.location="cart.php"</script>';
            break;
    }
}
?>

<!doctype html>
<html>
<head>
    <title>Eat Your Books - cart</title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/cart.css">
</head>

<body>
<main>
    <img id="pageHead" src="image/shopping_head.png">
    <!--   command buttons-->
    <h1>Your Shopping Cart</h1>

    <section id="topSection">

        <a href="cart.php?action=empty" class="commandButton">Clear Cart</a>
        <a href="checkout.php" class="commandButton">Proceed to Checkout</a>
        <?php
        $link = "";
        if(isset($_SESSION["categoryId"])){
            $link = "category.php?categoryId=".$_SESSION['categoryId'];
        }else{
            $link = "index.php?";
        }
        echo "<a href=$link><button class=\"commandButton\">Continue Shopping</button></a>";
        ?>

    </section>
        <?php
        if(isset($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
            ?>

    <section id="midSection">
        <table>
            <tr>
                <th class="bookIdColumn">BookId</th>
                <th class="titleColumn">Title</th>
                <th class="quantityColumn">Quantity</th>
                <th class="priceColumn">Price</th>
                <th class="totalPriceColumn">Total Price</th>
                <th class="removeColumn">Remove</th>
            </tr>
            </table>

            <?php
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                <table>
                <tr>

                    <td class="bookIdColumn"><?php echo $item["bookId"]; ?></td>
                    <td class="titleColumn"><?php echo $item["name"]; ?></td>
                    <td class="quantityColumn"><?php echo $item["quantity"]; ?></td>
                    <td class="priceColumn"><?php echo "$ ".$item["price"]; ?></td>
                    <td class="totalPriceColumn"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td class="removeColumn"><a href="cart.php?action=remove&bookId=<?php echo $item["bookId"]; ?>"
                    <td><img class="btnRemoveAction" src="image/remove.png" alt="Remove Item"/></td>
                </tr>
            </table>


        <?php
        $total_quantity += $item["quantity"];
        $total_price += ($item["price"]*$item["quantity"]);
        }
        ?>

    </section>


        <section id="bottomSection">
        <td class="totalColumn"  align="right">Total:</td>
            <td align="right"><?php echo $total_quantity; ?></td>
            <td align="right" ><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
            <?php
        }else {
            ?>
            <div id="emptycart">Your Cart Is Empty!<br>
                <br>Explore More Delicious Books!</div>
                <br>
            <?php
        }
        ?>
    </section>

</main>
</body>
<?php
include('footer.php')
?>
</html>