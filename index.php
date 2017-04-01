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
    <?php include "top.php" ?>
    
    <title>PigPen</title>
    
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
    <meta name="description" content="">
    <meta name="author" content="Jim Conallen">
    <link rel="icon" href="./images/bluemix_icon.png">
    
    <meta charset="utf-8">
    <meta name="author" content="Scrum Masters">
    <meta name="description" content="Dor Cleaner">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="clean.css" type="text/css" media="screen">
    
    

    <!-- Bootstrap core CSS -->
<!--     <link href="./css/bootstrap.min.css" rel="stylesheet"> -->

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
    <!-- Main Nav -->
    <nav class="light-blue lighten-4">
      <a href="/" class="brand-logo black-text">PigPen</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="?Page=registration"><i class="material-icons black-text">settings</i></a></li>
      </ul>
    </nav> <!-- !End nav -->
    
    <!-- Container for services -->
    <div class="container">
      <div class="row">
        <?php
          if (isset($_GET['Page'])) {
            include $_GET['Page'] . ".php";
          } else {
            include "forum.php";
          }
          
        ?>
	<iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d2846.758532636042!2d-73.20751718440908!3d44.479122079101714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x4cca7a5beeaf827f%3A0x7ffeed5fea2eed3b!2sWaterman+Building%2C+South+Prospect+Street%2C+Burlington%2C+VT!3m2!1d44.4782586!2d-73.20114699999999!4m5!1s0x4cca7af6406aaf27%3A0x7cd7226270a51992!2s28+Buell+Street%2C+Burlington%2C+VT!3m2!1d44.479216!2d-73.21009099999999!5e0!3m2!1sen!2sus!4v1491083864297" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div> <!-- !End Container>
=======
=======
>>>>>>> origin/master
<html>
<?php include "top.php" ?>
<body>
    <!-- Main Nav -->
    <nav class="blue">
      <a href="?" class="brand-logo">PigPen</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="?Page=registration"><i class="material-icons">settings</i></a></li>
      </ul>
    </nav> <!-- !End nav -->
    
    <!-- Container for services -->
    <div class="container">
      <div class="row">
        <?php
          if (isset($_GET['Page'])) {
            include $_GET['Page'] . ".php";
          } else {
            include "forum.php";
          }
          
        ?>
	<iframe src="https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d2846.758532636042!2d-73.20751718440908!3d44.479122079101714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x4cca7a5beeaf827f%3A0x7ffeed5fea2eed3b!2sWaterman+Building%2C+South+Prospect+Street%2C+Burlington%2C+VT!3m2!1d44.4782586!2d-73.20114699999999!4m5!1s0x4cca7af6406aaf27%3A0x7cd7226270a51992!2s28+Buell+Street%2C+Burlington%2C+VT!3m2!1d44.479216!2d-73.21009099999999!5e0!3m2!1sen!2sus!4v1491083864297" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>
    </div> <!-- !End Container>
>>>>>>> 6712db5a72bb46a3776f21dccb0925345379aee0
	

	
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
