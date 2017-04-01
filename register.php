<?php
include top.php;
?>

<html>
   <head>
      <title>Sign up for our services!</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">      
	  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
   </head>
   <body class="container">   
       <h1>Register to be a cleaner / cleanee!</h1>
      <div class="row" style =" position: relative; top:20%">
         <form class="col s12">
        <div class="row">
          <i class="material-icons prefix">phone</i>
          <input id="icon_telephone" type="tel" class="validate">
          <label for="icon_telephone">Telephone</label>
        </div>
            <div class="row">
               <div class="input-field col s12">
			      <i class="material-icons prefix">markunread_mailbox</i>
                  <textarea id="address" class="materialize-textarea"></textarea>
                  <label for="address">Address</label>
               </div>
            </div>			
           
            <div class="row">
               <div class="input-field col s12">
                   <p>
                     <input id="cleaner" type="radio" name="job" value="cleaner" checked>
                     <label for="cleaner">Cleaner</label>
                  </p>
                  <p>
                     <input id="cleanee" type="radio" name="job" value="cleanee" checked>
                     <label for="cleanee">Cleanee</label>
                  </p>
                  <p>

                  </p>
               </div>
            </div>           
         </form>       
      </div>
   </body>   
</html>
