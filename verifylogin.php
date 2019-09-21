<?php
function processInput($input) {
    $input = htmlspecialchars(stripslashes(trim($input)));
    return $input;
}

# get form data
$un = processInput($_POST['username']);
$pw = processInput($_POST['password']);

# connect to db
$dbhost = "localhost";
$dbuser = "root";
$dbpass = '';
$db = "hosa";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

# check if credentials match
$query = "SELECT password FROM members WHERE studentId = '" . $un . "'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
if($row["password"] == $pw) {
    # login
    setcookie('loggedin', 'true');
    setcookie('user', $un);
    header("Location: /hosa.php");
} else {
    # TODO alert user that didn't work
    header("Location: /login.html");
}


?>