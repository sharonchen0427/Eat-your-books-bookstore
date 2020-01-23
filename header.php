<?php
session_start();
$db = mysqli_connect("127.0.0.1", "root", "88", "bookstore");

?>
<header>
    <div id="leftHeader">
        <a href="index.php">
            <img src="image/home/bookstore_logo.png" alt="Eat Your Books logo"/>
        </a>
    </div>

    <div id="midHeader">
        <form id="searchBoxForm">
            <input id="searchBox" type="text" value="Search">
            <a href="https:www.alibris.com/booksearch"><img id="searchIcon" type="image" height="25" width="25"
                                                            src="image/home/search_icon.png" alt="search icon"></a>
        </form>
        <div class="dropdown">
            <p class="dropdownSelect">Select Category</p>
            <div class="dropdownContent">
                <?php

                $query = "SELECT * FROM category ORDER BY categoryId ASC ";
                $result = mysqli_query($db, $query);
                     if (mysqli_num_rows($result) > 0) {
                        while ($category = mysqli_fetch_array($result)) {

                        echo "
                <p><a href='category.php?categoryId=$category[categoryId]'>".$category['name']."</a></p>";

                        }
                    }
                ?>

            </div>


        </div>
    </div>
    <div id="rightHeader">
        <div id="cartIcon"><a href="cart.php">
                <img height="25" width="25" src="image/home/cart_icon.png" alt="shopping cart icon"></a>
        </div>
        <div id="cartCount">
        <?php
        if(isset($_SESSION['cart_item'])){
            $total_quantity = 0;
            $total_price = 0;
            foreach ($_SESSION["cart_item"] as $item) {
                $total_quantity += $item["quantity"];
            }
            if ($total_quantity>1) {
                echo "<a href='cart.php'>" . $total_quantity . " items";
            }else{
                echo"<a href='cart.php'>".$total_quantity." item";
            }
        }
        ?>


        </div>

        <?php
        if (isset($_SESSION['validuser'])) {

        echo "<div id=\"loginButton\"><a href=\"login.php\">Sharon</a></div>";

        }else {
            ?>

            <div id="loginButton"><a href="login.php">login</a></div>
            <?php
        }
        ?>
    </div>
</header>