<?php
if (!empty($_POST['cmd'])) {
    if ($_POST['cmd'] == "cat /var/www/html/error.log") {
    	$cmd = shell_exec($_POST['cmd']);
    }
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ribbon Security</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
		<style>
        h2 {
            color: rgba(0, 0, 0, .75);
        }
        pre {
            padding: 15px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            background-color: #ECF0F1;
        }
        .container {
            width: 850px;
        }
    </style>
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
				<p><div class="container">

        <div class="pb-2 mt-4 mb-2">
            <h2> Execute a command </h2>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="cmd"><strong>Command</strong></label>
                <input type="text" class="form-control" name="cmd" id="cmd" value="<?= htmlspecialchars($_POST['cmd'], ENT_QUOTES, 'UTF-8') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Execute</button>
        </form>

<?php if ($cmd): ?>
        <div class="pb-2 mt-4 mb-2">
            <h2> Output </h2>
        </div>
        <pre>
<?= htmlspecialchars($cmd, ENT_QUOTES, 'UTF-8') ?>
        </pre>
<?php elseif (!$cmd && $_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div class="pb-2 mt-4 mb-2">
            <h2> Output </h2>
        </div>
        <pre><small>No result.</small></pre>
<?php endif; ?>
    </div></p>
				
			</div>
		</div>
	</body>
</html>

