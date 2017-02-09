
<!DOCTYPE html>
<html>
<head>
	<title>PHP Starter Application</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css" />
</head>
<body>
	<table>
		<tr>
			<td style='width: 30%;'>
				<img class = 'newappIcon' src='images/newapp-icon.png'>
			</td>
			<td>
				<h3 id = "message"><?php echo "Hello World!"; ?></h3>
				<p>Look at the PHP <a href="info.php">info</a>.</p>
				<p>Edit the <a href="messages.php">messages</a>.</p>
				<p><a href="init.php">Initialize the db </a>.</p>
				<p> Thanks for creating a <span class="blue">PHP + MySQL Starter Application</span>.</p>
			</td>
		</tr>
	</table>
</body>
</html>