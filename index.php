<!DOCTYPE html>
<?php
if(!isset($_COOKIE['loggedin'])) {
    setcookie('loggedin', 'false');
    header("Location: /hosa.php");
}
?>
<html>
	<head>
		<title>CHS HOSA</title>
		<link rel="stylesheet" href="hosaisstylish.css"/>
	</head>
	<body>
		<div id="nav-bar">
			<div class="nav-link" id="home">
				<a href="/hosa.php"><img src="/img/blue-chshosa-logo.png" alt="HOSA logo" id="hosa_logo"/></a>
			</div>
            <a href="/calendar.html"><div class="nav-link" id="calendar-link">
                Calendar
            </div></a>
            <?php
            if($_COOKIE["loggedin"] == 'true') {
				# connect to db
				$dbhost = "localhost";
				$dbuser = "root";
				$dbpass = '';
				$db = "hosa";

				$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

				$un = $_COOKIE['user'];
				$query = "SELECT officer FROM members WHERE studentId = '" . $un . "'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				if($row["officer"] == 1) {
					echo '<a href="/records.php"><div class="nav-link" id="records-link">Records</div></a>';
				}
            }
            ?>
                <?php if($_COOKIE['loggedin'] == 'false') {echo '<a href="/login.html"><div class="nav-link" id="login">Login/Register</div></a>';}
                else{echo '<a onclick="logout()" style="cursor:pointer"><div class="nav-link" id="login">Logout</div></a>';}?>
		
		</div>
		<h1>Welcome to CHS HOSA</h1>
        <p>You are currently <?php
if($_COOKIE['loggedin'] == 'false') {
    echo "not ";
} ?>logged in<?php if($_COOKIE['loggedin'] == 'true') {echo " as " . $_COOKIE['user'];} ?>.</p>
        
        <script>
            function logout() {
                document.cookie="user=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                document.cookie="loggedin=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                location.reload();
            }
        </script>
	</body>
</html>