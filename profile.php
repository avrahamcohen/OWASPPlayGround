<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit();
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'root';
$DATABASE_NAME = 'users';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	die ('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT username, password FROM accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.

$id=0;
if ($_GET['user'] == 'Admin') $id = 1; 
if ($_GET['user'] == 'John') $id = 2;
if ($_GET['user'] == 'Dave') $id = 3;

$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->bind_result($username, $password);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ribbon Security</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Web Application Challenge by Ribbon Application Security</h1>
				<a href="home.php"><i class="fas fa-home"></i>Home</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$username?></td>
					</tr>	
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<?php 
							if ($_GET['user'] == "<script>alert(document.user);</script>" or $_GET['user'] == "<script>alert(document.user)</script>") {
								echo "<script>alert('ldza5787')</script>";
							}
						?>
					</tr>
				</table>
			</div>
			<p>TODO: Remove document.user field.</p>
		</div>
	</body>
</html>
