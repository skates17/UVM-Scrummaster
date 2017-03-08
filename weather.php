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

<?php

$vcap_services_str = getenv("VCAP_SERVICES");

if(!$vcap_services_str){ // local dev env
    
	// try to load local copy of vcap services environment variable.  This will 
	// set the services credentials to be the bluemix ones. Unlike the db version
	// we don't have a local option, so there must always be a file
    if( file_exists("vcap.json") ) {
    	$vcapfile = fopen("vcap.json", "r") or die("Unable to open file!");
    	$vcap_services_str = fread($vcapfile,filesize("vcap.json"));
    	fclose($vcapfile);
    } 
    
} 

if( $vcap_services_str ) {
	// either on bluemix, or local file
	$vcap_services = json_decode($vcap_services_str);
	if( isset($vcap_services->{'weatherinsights'}) ){ 
		$cred = $vcap_services->{'weatherinsights'}[0]->credentials;
	} 
	else {
		echo '<div class="alert alert-warning" role="alert">';
		echo '<strong>Error:</strong> No weather api bound to the application.' . mysqli_error();
		echo '</div>';
		die();
	}
	$weather_url = $cred->url;


} else {
	// no vcap found.  
	echo '<div class="alert alert-danger" role="alert">';
	echo '<strong>Error:</strong> No VCAP Services file found';
	echo '</div>';
	die();
}

// default zip
$zip = '18964';

if ($_SERVER["REQUEST_METHOD"] == "POST") { // get weather for zip code
	if( is_numeric ( $_POST["zip"] )  ) {
		$zip = sprintf('%05u', $_POST["zip"]);
	} else {
		echo '<div class="alert alert-warning" role="alert">';
		echo '<strong>' . $_POST["zip"] . '</strong> is not a valid US zip code.  Using default zip.';
		echo '</div>';
	}
}


// GET /v1/location/18964:4:US/observations.json
$url = $weather_url . '/api/weather/v1/location/' . $zip . ':4:US/observations.json';

$response = file_get_contents($url);
$jsonResponse = json_decode($response); 
$conditions = $jsonResponse->{"observation"};
$temp = $conditions->{"temp"};
$phrase = $conditions->{"wx_phrase"};
$pressure = $conditions->{"pressure"};
$feelsLike = $conditions->{"feels_like"};
$windSpeed = $conditions->{"wspd"};
$windDirection = $conditions->{"wdir_cardinal"};
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

<title>PHP MySQL Hackathon Example - Current Weather</title>

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
	<h1>Example Weather API Page</h1>
</div>

<div class="container">
<form class="form-inline" method="post">
  <label class="sr-only" for="todo">Zip Code</label>
  <input type="text" class="form-control mb-4 mr-sm-4 mb-sm-0" id="zip" name="zip" placeholder="Zip Code...">
  <button type="submit" class="btn btn-primary">Get Current Conditions</button>
</form>
</div>

<div class="container">
	<h3>Current conditions in <?php echo $zip . ' are ' . $phrase; ?> </h3>
	<p>Temp: <?php echo $temp ?> F</p>
	<p>Feels Like: <?php echo $feelsLike ?> F</p>
	<p>Wind: <?php echo $windSpeed.' '.$windDirection ?></p>
	<p>Pressure: <?php echo $pressure ?></p>
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
</body>
</html>
