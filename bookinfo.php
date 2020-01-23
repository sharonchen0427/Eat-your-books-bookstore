<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Book Info</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/bookinfo.css"/>
</head>
<body>

<?php
include('header.php');
?>

<main>
    <section>

    <?php
    require_once("dbcontroller.php");
    $db_handle = new DBController();

    $query = "SELECT * FROM info ORDER BY bookId ASC";
    $info = $db_handle->runQuery($query);
    if(!empty($info)) {
        foreach ($info as $k=>$v) {
        if ($info[$k]['bookId'] == $_GET['bookId']) {
            echo "
            <h1>" . $info[$k]['name'] . "</h1>
            <img src='image/" . $info[$k]['image'] . ".png'>
            <h5>
                " . $info[$k]['description'] . "；
            </h5>
            <br>
            <a href='category.php?categoryId=" . $info[$k]['categoryId'] . "' class='commandButton'> Return to Category Page </a>
            
             ";
            }
        }
    }
         ?>

    </section>

</main>

<?php
include('footer.php');
?>
</body>
</html>
