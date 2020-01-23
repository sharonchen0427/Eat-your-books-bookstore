<?php
include('header.php');
require_once("dbcontroller.php");
$db_handle = new DBController();
?>

<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Database</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>


</head>
<body>

<table class="database">
    <tr>
        <th>Book Id</th>
        <th>Book Name</th>
        <th>Author</th>
        <th>Price</th>
        <th>Category ID</th>
        <th>Read or Not</th>
    </tr>

    <?php
    // Retrieve data from the database,
    $db = new mysqli('127.0.0.1', 'root', '88', 'bookstore');
    $query = "SELECT bookId, name,author, price,categoryId,book.read FROM bookstore.book";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($books as $book) {

        echo "<td> ".$book["bookId"]." </td>";
        echo "<td> ".$book["name"]." </td>";
        echo "<td> ".$book["author"]." </td>";
        echo "<td> ".$book["price"]." </td>";
        echo "<td> ".$book["categoryId"]." </td>";
        echo "<td> ".$book["read"]." </td>";
        echo "<tr>";
    }

    ?>
</table>

</body>
<?php
include('footer.php')
?>
</html>