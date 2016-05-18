<!DOCTYPE html>
<?php
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
if($row["officer"] != 1) {
	header("Location: /hosa.php");
}
?>
<html>
	<head>
		<title>Records</title>
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
			<a href="/records.php"><div class="nav-link" id="records-link">Records</div></a>
                <?php if($_COOKIE['loggedin'] == 'false') {echo '<a href="/login.html"><div class="nav-link" id="login">Login/Register</div></a>';}
                else{echo '<a onclick="logout()" style="cursor:pointer"><div class="nav-link" id="login">Logout</div></a>';}?>
		</div>
		<br>
		<br>
		<p>This is where officers will update the official HOSA Records. If you are not an officer, you should not be seeing this page.</p>
		<form name="update_meetings" id = "update_meetings" method="post">
			<h4>Meetings</h4>
			<p>
				<select name="studentName">
					<option value="default">Select student:</option>
					<?php
						# connect to db
						$dbhost = "localhost";
						$dbuser = "root";
						$dbpass = '';
						$db = "hosa";

						$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

						# get list of members
						$query = "SELECT firstName, lastName FROM members ORDER BY firstName";
						$result = mysqli_query($conn, $query);
						
						# create option for each member
						while($row = mysqli_fetch_assoc($result)) {
							echo "<option value = \"" . $row["firstName"] . " " . $row["lastName"] . "\">" . $row["firstName"] . " " . $row["lastName"] . "</option>";
						}
					?>
				</select></p>
				<p><select name="meeitngDate">
					<option value="default">Select meeting:</option>
					<?php
						# connect to db
						$dbhost = "localhost";
						$dbuser = "root";
						$dbpass = '';
						$db = "hosa";

						$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

						# get list of members
						$query = "SELECT date FROM meetings ORDER BY date DESC";
						$result = mysqli_query($conn, $query);
						
						# create option for each meeting
						while($row = mysqli_fetch_assoc($result)) {
							echo "<option value = \"" . $row["date"] . "\">" . $row["date"] . "</option>";
						}
					?>
				</select></p>
				<p><select name="present">
					<option value="default">Present?</option>
					<option value="1">Yes</option>
					<option value="0">No</option>
				</select></p>
				<p><input type="submit" value="Update"></p>
		</form>
		<form name="update_service" id="update_service">
			<h4>Service Projects</h4>
			<p><select name="studentName">
				<option value="default">Select student:</option>
				<?php
					# connect to db
					$dbhost = "localhost";
					$dbuser = "root";
					$dbpass = '';
					$db = "hosa";

					$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

					# get list of members
					$query = "SELECT firstName, lastName FROM members ORDER BY firstName";
					$result = mysqli_query($conn, $query);

					# create option for each member
					while($row = mysqli_fetch_assoc($result)) {
						echo "<option value = \"" . $row["firstName"] . " " . $row["lastName"] . "\">" . $row["firstName"] . " " . $row["lastName"] . "</option>";
					}
				?>
			</select></p>
			<p><select name="meeitngDate">
					<option value="default">Select project:</option>
					<?php
						# connect to db
						$dbhost = "localhost";
						$dbuser = "root";
						$dbpass = '';
						$db = "hosa";

						$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

						# get list of members
						$query = "SELECT name, projectId FROM projects ORDER BY name DESC";
						$result = mysqli_query($conn, $query);
						
						# create option for each meeting
						while($row = mysqli_fetch_assoc($result)) {
							echo "<option value = \"" . $row["projectId"] . "\">" . $row["name"] . "</option>";
						}
					?>
				</select></p>
				<p><input type="text" name="weight" value="Weight" id="weightInput"></p>
				<p><input type="submit" value="Update"></p>
		</form>
		<script>
			function logout() {
                document.cookie="user=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                document.cookie="loggedin=; expires=Thu, 01 Jan 1970 00:00:00 UTC";
                location.reload();
            }

            var weightInput = document.getElementById("weightInput");
            weightInput.onfocus = function(e) {
            	e.target.type = "number";
            	e.target.value = 1;
            }
            weightInput.onblur = function(e) {
            	if(e.target.value == "") {
            		e.target.type = "text";
            		e.target.value = "Weight";
            	}
            }
		</script>
	</body>
</html>