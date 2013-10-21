<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to Marketingbazar</title>
<link rel="stylesheet" href="www/css/main.css" type="text/css" />
</head>
<body>
	<div id="container">
		<h1>Welcome back, <?php echo $userid?> !</h1>
		<div id="body">
			<?php print_r($userid);?>
		</div>
		<div>
			<a href="/auth/logout">Click to logout</a>
		</div>
		<p class="footer">
			Page rendered in <strong>{elapsed_time}</strong> seconds
		</p>
	</div>
</body>
</html>