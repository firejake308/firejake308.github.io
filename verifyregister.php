<?php
function processInput($input) {
    $input = htmlspecialchars(stripslashes(trim($input)));
    return $input;
}

# get form data
$fn = processInput($_POST['firstname']);
$ln = processInput($_POST['lastname']);
$id = processInput($_POST['studentid']);
$ethnicity = processInput($_POST['ethnicity']);
$grade = processInput($_POST['grade']);
$address = processInput($_POST['address']);
$city = processInput($_POST['city']);
$zip = processInput($_POST['zip']);
$personalEmail = processInput($_POST['personalemail']);
$parentEmail = processInput($_POST['parentemail']);
$yearsBefore = processInput($_POST['yearsBefore']);
$career = processInput($_POST['career']);
$competition = processInput($_POST['competition']);
$meetingTime = processInput($_POST['meetingTime']);
$shirtSize = processInput($_POST['shirtSize']);
$password = processInput($_POST['setpassword']);

# submit to mySQL
$dbhost = "localhost";
$dbuser = "root";
$dbpass = '';
$db = "hosa";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

mysqli_query($conn, "INSERT INTO Members (`studentId`, `firstName`, `lastName`, `ethnicity`, `grade`, `address`, `city`, `zip`, `personalEmail`, `parentEmail`, `yearsBefore`, `career`, `competition`, `meetingTime`, `shirtSize`, `password`) VALUES (" . $id . ", '" . $fn . "', '" . $ln . "', '" . $ethnicity . "', " . $grade . ", '" . $address . "', '" . $city . "', " . $zip . ", '" . $personalEmail . "', '" . $parentEmail . "', " . $yearsBefore . ", '" . $career . "', '" . $competition . "', '" . $meetingTime . "', '" . $shirtSize . "', '" . $password . "')") or die(mysqli_error($conn));

# log in and head to home page
setcookie('loggedin', 'true');
setcookie('user', $id);
header("Location: /hosa.php");

?>