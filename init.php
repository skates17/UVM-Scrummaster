<!--
/**
 * Copyright 2017 IBM Corp. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* https://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
-->

<?php include 'db.php';?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jim Conallen">
    <link rel="icon" href="./images/bluemix_icon.png">

    <title>PHP MySQL Hackathon Example - Initialize DB</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<div class="container">
<h1>Initializing DB</h1>

<?php
$sqlTable="DROP TABLE IF EXISTS todos";
if ($mysqli->query($sqlTable)) {
    echo '<div class="alert alert-success" role="alert">';
  	echo 'Table dropped successfully!';
  	echo '</div>';
} else {
	echo '<div class="alert alert-warning" role="alert">';
	echo 'Cannot drop table.' . mysqli_error();
	echo '</div>';
}

echo '<div class="alert alert-success" role="alert">';
echo 'Executing CREATE TABLE Query...';
echo '</div>';


$sqlTable="
CREATE TABLE todos (
 id bigint(20) NOT NULL AUTO_INCREMENT,
 time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
 todo varchar(255) DEFAULT NULL,
 PRIMARY KEY (id)
) DEFAULT CHARSET=utf8
";

if ($mysqli->query($sqlTable)) {
	echo '<div class="alert alert-success" role="alert">';
	echo 'Table created successfully!';
	echo '</div>';
} else {
	echo '<div class="alert alert-danger" role="alert">';
	echo '<strong>ERROR</strong>: Cannot create table.' . mysqli_error();
	echo '</div>';
	die();
}
?>

<button type="button" class="btn btn-primary" onclick="window.location = 'todos.php';">Back to TODOs Page</button>
</div>

</body>
</html>