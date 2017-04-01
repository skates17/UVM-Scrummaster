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
