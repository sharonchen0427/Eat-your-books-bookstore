<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Log Out</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/logout.css"/>

</head>
<body>

<?php
include('header.php');
echo "<main>";
echo "<h1>Log Out</h1>";
// Check to make sure the user was logged in
if (isset($_SESSION['validuser'])){
    unset($_SESSION['validuser']);
    session_destroy();
    echo "<p>You have been logged out</p>";
} else {
    // if they weren't logged in but came to this page
    echo '<p>You were not logged in, and so have not been logged out.</p>';
}

echo '<p><a href="login.php">Back to Login Page</a></p>';
echo "</main>";
include('footer.php');
?>
</body>
</html>
