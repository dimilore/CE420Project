<!DOCTYPE html>
<html>
<head>
	<title>You have logged out</title>
	<link rel="stylesheet" type="text/css" href="css/messeges.css" />
	<script src="javascript/countdown.js" type="text/javascript" ></script>
</head>

<body>
<?php
session_start();
session_destroy();
echo "<p>You have been logged out.</br> <a href=\"index.php\">Go back to Start Page</a><p>";
?>
<h2>You will be automatically redirected in <span id="count"></span> seconds</h2>
</body>
</html>