<!doctype html>
<html lang="en">
<head>
    <title>Eat Your Books - Log In</title>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>

</head>
<body>

<?php
include('header.php');
echo "<main>";
echo "<h1>Log In</h1>";
if($_SERVER['REQUEST_METHOD']=='POST'){
    $userName=$_POST['username'];
    $password=$_POST['password'];
    if($userName=='Sharon' AND $password=='3540_101'){
        $_SESSION['validuser'] = $userName;
    }
}
if (isset($_SESSION['validuser'])) {
    echo "<p class='validEntry'>You are logged in as " .$_SESSION['validuser']. "</p>";
    echo "<div id = 'buttonContainer'>";
    echo "<p id='logout'><a href = 'logout.php'>Log Out</a></p>";
    echo "</div>";
} else {


// User has not logged unsuccessfully.  Either login has failed or they haven't tried.
// Display appropriate message and show form to enter credentials.
    if (isset($userName)) {
        // if they've tried and failed to log in
        echo '<p id="invalidEntry">UserName or password not found. Please try again.</p>';
    } else {
        // they have not tried to log in yet or have logged out
        echo '<p id="loginInfo">You are not logged in.</p>';
        // form to log in
    }
        echo "<div class='loginContainer'>";
        echo '<form id="loginForm" action="login.php" method="post">';
        echo '<p><label for="username">User Name</label>';
        echo '<input type="text" name="username" id="username" size="30"/></p>';
        echo '<p><label for="password">Password</label>';
        echo '<input type="password" name="password" id="password" size="30"/></p>';
        echo '<button type="submit" name="login">Login</button>';
        echo '</form>';
        echo "</div>";


}
echo "</main>";
include('footer.php');
?>
</body>
</html>

