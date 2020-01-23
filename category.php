<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books</title>
    <meta charset="utf-8">
    <meta name="description" content="The homepage for Eat Your Books">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/category.css">
</head>

<body class="home">
<main>
    <?php
    include('header.php');
    //category session
      $_SESSION['categoryId']=1;
    ?>

    <article>
        <section>
            <?php
            $query = "SELECT * FROM category ORDER BY categoryId ASC ";
            $db = mysqli_connect("127.0.0.1", "root", "88", "bookstore");
            $result = mysqli_query($db,$query);
            if(mysqli_num_rows($result) > 0) {
                while ($pageHead = mysqli_fetch_array($result)) {
                    if ($pageHead['categoryId'] == $_GET['categoryId']) {
                        echo "<img class='pageHead' height='330' width='1150' src='image/page" . $pageHead['categoryId'] . "head.png' alt='page" . $pageHead['categoryId'] . "head photo'>";
                    }
                }
            }
            ?>

        </section>

        <section class="itemContainer">

            <div class="leftSection">
                <div>

                    <?php
                    $query = "SELECT * FROM category ORDER BY categoryId ASC ";
                    $result = mysqli_query($db,$query);
                    if(mysqli_num_rows($result) > 0) {
                        while ($tag = mysqli_fetch_array($result)) {
                            if ($tag['categoryId'] == $_GET['categoryId']) {
                                echo "<div class='tag active'>
                     <h2> <a href='category.php?categoryId=" . $tag['categoryId'] . "'>" . $tag['name'] . "</a></h2>
                </div>";
                            } else {
                                echo "<div class='tag'>
                     <h2> <a href='category.php?categoryId=" . $tag['categoryId'] . "'>" . $tag['name'] . "</a></h2> </div>";
                            }

                        }
                    }
                    ?>
                </div>

            </div>

            <div class="rightSection">
                <div>

                    <?php
                    require_once("dbcontroller.php");
                    $db_handle = new DBController();
                    $product_array = $db_handle->runQuery("SELECT * FROM book ORDER BY bookId ASC");
                    if (!empty($product_array)) {
                        foreach ($product_array as $key => $value){
                            if ($product_array[$key]['categoryId'] == $_GET['categoryId']) {
                    ?>

                    <div class='item'>
                        <form method="post"
                              action="cart.php?action=add&bookId=<?php echo $product_array[$key]["bookId"]; ?>">
                            <img class="book-picture" src="<?php echo "image/" . $product_array[$key]["image"] . ".png"; ?>">

                        <h4><?php echo $product_array[$key]["name"]; ?><br>
                            <br><?php echo "by " . $product_array[$key]["author"]; ?><br>
                            <br><?php echo "$" . $product_array[$key]["price"]; ?><br>
                            <input type="hidden" class="product-quantity" name="quantity" value="1"
                                                            size="2"/>
                            <span><input type="submit" value="Add to Cart"
                                  class="btn btn-green btn-green-center" name="add"/></a></span>
                          <?php
                            if ($product_array[$key]['read'] == 1) {
                            echo "<span><a href='bookinfo.php?bookId=".$product_array[$key]['bookId']."'><button class='btn btn-green btn-green-center' type='button'>Read Now</button></a></span>";
                            }
                          ?>
                        </h4>
                        </form>
                    </div>

                    <?php
                            }
                        }
                    }
                ?>
                </div>
            </div>

        </section>
    </article>

    <?php
    include('footer.php')
    ?>

</main>
</body>
</html>