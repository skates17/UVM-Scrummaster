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
