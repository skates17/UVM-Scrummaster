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

    <title>PHP MySQL Hackathon Example - Home</title>

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


    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>PHP, MySQL and Weather, oh my.</h1>
        <p>
        This page is based off the <a href="http://getbootstrap.com/examples/jumbotron/">Jumbotron Bootstrap template</a>.
        It is useful for a big opening splash of a home page.
        </p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>MySQL</h2>
          <p>
          This application example uses the MySQLi extension.  By default Bluemix does not automatically 
          include this extension when deploying PHP applications in Cloud Foundry.  A composer.json file
          was added to the root folder with the proper json to tell Bluemix to include it when deploying.
          </p>
          <p><a class="btn btn-default" href="todos.php" role="button">View database page &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Weather API</h2>
          <p>
          This application uses the Weather API to get the current conditions for a specific location (specified
          by a US zip code).  The app makes a REST call to the weather server and displays only some of the 
          information on the page. 
          </p>
          <p><a class="btn btn-default" href="weather.php" role="button">View current weather &raquo;</a></p>
       </div>
      </div>

      <hr>

      <footer>
        <p>&copy; 2017 IBM Corporation</p>
        <p>
        <a target="_blank" href="https://console.ng.bluemix.net/devops/setup/deploy/?repository=https%3A%2F%2Fgithub.com%2Fjconallen%2FPHP-MySQL-Hackathon-Example">
        <button type="submit" class="btn btn-primary">
        	<img style="width:20px;height:20px;" src="./images/IBM_Bluemix_logo.svg.png">
  			Deploy to Bluemix Toolchain
		</button>
		</a>
        </p>
      </footer>
    </div> <!-- /container -->

	
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
