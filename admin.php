<?php
include('header.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Admin</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>

</head>
<body>


<section class="">
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){// if (isset($_POST['customerName'])) {
        $error=0;
        if($_POST['bookId']=='') {
            echo "<p>You must enter Book Id</p>";
            $error++;
        }
        if($_POST['name']=='') {
            echo "<p>You must enter Book Name</p>";
            $error++;
        }
        if($_POST['author']==''){
            echo "<p>You must enter Author Name</p>";
            $error++;
        }
        if($_POST['price']==''){
            echo "<p>You must enter Book Price</p>";
            $error++;
        }
        if($_POST['categoryId']==''){
            echo "<p>You must enter Book Category Id</p>";
            $error++;
        }
        if($_POST['read']==''){
            echo "<p>You must make sure to show book: Read or Not</p>";
            $error++;
        }
        if (!$error) {
            header('Location: bookdatabase.php');

        }
    }
    ?>
</section>

<section class="insertBook">
    <h1>Administration Platform</h1>
    <form id="insertBookForm" action="admin.php" method="post">
        <p>Please enter the following information:</p>
        <div>
        <label>
            Book Id:
        </label>
        <input name="bookId" type="text" placeholder="Enter Book Id" autofocus="autofocus";>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST")
            echo "value=".$_POST['bookId']."";
        ?>
        </div>
        <div>
        <label>
            Name:
        </label>
        <input name="name" type="text" placeholder="Enter Book Name"
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                echo "value=".$_POST['name']."";
            ?>
        ></div>
        <div>
        <label>
            Author:
        </label>
        <input name="author" type="text" placeholder="Enter Author Name"
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                echo "value=".$_POST['author']."";
            ?>
        ></div>
        <div>
        <label>
            Price:
        </label>
        <input name="price" type="text" placeholder="Enter Book Price"
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST")
                echo "value=".$_POST['price']."";
            ?>
        >
        </div>
        <div>
            <label>
                Category Id:
            </label>
            <input name="categoryId" type="text" placeholder="Enter Book Category Id"
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                    echo "value=".$_POST['categoryId']."";
                ?>
            >
        </div>

        <div>
            <label>
                Read or Not:
            </label>
            <input name="read" type="text"
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                    echo "value=".$_POST['read']."";
                ?>
            >
        </div>

        <input type="submit" name="submit" value="submit">
    </form>
</section>
<?php
$db = new mysqli('127.0.0.1', 'root', '88', 'bookstore');
$error=0;
if(!$error){
    $query = "INSERT INTO bookstore.book(`bookId`, `name`, `author`, `price`, `categoryId`,`read`) VALUES (?,?,?,?,?,?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ssssss',$_POST['bookId'],$_POST['name'],$_POST['author'], $_POST['price'], $_POST['categoryId'], $_POST['read']);
    $stmt->execute();
}

?>



</body>
<?php
include('footer.php')
?>
</html>