<!DOCTYPE html>

<html lang="en">
<head>
    <title>Eat Your Books</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<?php
include('header.php')
?>

<article>
    <h1 id="welcome"><br>Welcome to the most delicious bookstore in town!</h1>
    <div class="content">
        <section class="leftText">
            <p>Eat Your Books has indexed over 2000 cookbooks and 1.5 million recipes. Search and find all recipes in your cookbooks, magazines & favorite blogs.</p>
            <p>Tag your books and recipes any way you want. Organize books by location, tag your favorite recipes, create menus for special events.</p>
            <p>Join a community of cookbook lovers & discover that Eat Your Books is a great way to make better use of your own collection.</p>
        </section>
        <section class="rightNav">


            <div class='nav'>
                <?php
                $query = "SELECT * FROM category ORDER BY categoryId ASC ";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($category = mysqli_fetch_array($result)) {
                        echo "<a
                             href='category.php?categoryId=" . $category['categoryId'] . "'>
                                <p class='navText'>" . $category['name'] . "</p></a>";
                        echo "<a href='category.php?categoryId=" . $category['categoryId'] . "'>
                            <img class='navPic' src='image/home/" . $category['image'] . ".jpg' alt='" . $category['image'] . "'></a>
                      ";

                    }
                }

                ?>
            </div>

        </section>
    </div>
</article>

<?php
include('footer.php')
?>

</body>
</html>
