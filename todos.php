<?php include 'db.php';?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") { //if new message is being added
    $cleaned_message = preg_replace('/[^a-zA-Z0-9.\s]/', '', $_POST["todo"]); //remove invalid chars from input.
    $strsq0 = "INSERT INTO todos ( todo ) VALUES ('" . $cleaned_message . "');"; //query to insert new message
    if ($mysqli->query($strsq0)) {
        // echo "Insert success!";
    } else {
        echo '<div class="alert alert-danger" role="alert">';
        echo 'Cannot insert into the data table; check whether the table is created, or the database is active. '  . mysqli_error();
        echo '</div>';
        }
}
//Query the DB for messages
$strsql = "SELECT * FROM todos ORDER BY id DESC limit 100";
if ($result = $mysqli->query($strsql)) {
  // printf("<br>Select returned %d rows.\n", $result->num_rows);
} else {
	echo '<div class="alert alert-danger" role="alert">';
	echo '<strong>doh!</strong> Can\'t query the database, did you <a href = init.php>Create the table</a> yet?';
	echo '</div>';
}
?>
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

    <title>PHP MySQL Hackathon Example - TODOS Database</title>

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
<button type="button" class="btn btn-link" onclick="window.location = 'index.php';">Home</button>
<button type="button" class="btn btn-link" onclick="window.location = 'init.php';">Reset DB</button>
<h1>Example Database Page</h1>
</div>

<div class="container">
<form class="form-inline" method="post">
  <label class="sr-only" for="todo">TODO</label>
  <input type="text" class="form-control mb-4 mr-sm-4 mb-sm-0" id="todo" name="todo" placeholder="TODO...">
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>

<div class="container">
  <h2>TODOs</h2>
  <table class="table">
    <thead>
      <tr>
        <th class="col-xs-1">ID</th>
        <th class="col-xs-2">Timestamp</th>
        <th class="col-xs-9">TODO</th>
      </tr>
    </thead>
    <tbody>

<?php       
 			while ( $row = mysqli_fetch_row ( $result ) ) {
                echo "<tr>\n";
                for($i = 0; $i < mysqli_num_fields ( $result ); $i ++) {
                    echo '<td>' . "$row[$i]" . '</td>';
                }
                echo "</tr>\n";
            }
            $result->close();
            mysqli_close($mysqli);
?>
    </tbody>
  </table>
</div>
    

    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="./js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>