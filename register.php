<?php
include top.php;

$telephone="";
$address="";
$cleaner=false;
$cleanee=false;

$dataRecord = array();

if (isset($_POST["btnSubmit"])) {
    
    if (isset($_POST["telephone"])) {
    $dataRecord[]=$_POST["telephone"];

}
    if (isset($_POST["address"])) {
    $dataRecord[]=$_POST["address"];

}
    if (isset($_POST["job"])) {
    $dataRecord[]=$_POST["job"];
    
    echo '<h1>'.$dataRecord.'</h1>';

}
$pmkUsername = $_COOKIE['netId'];
}


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
       
       
      <div class="row">
          <form method ="POST" class="col s12" action="registrationSuccess.php">
        <div class="row">
          <i class="material-icons prefix">phone</i>
          <input id="telephone" type="tel" class="validate">
          <label for="telephone">Telephone</label>
        </div>
            <div class="row">
               <div class="input-field col s12">
			      <i class="material-icons prefix">mark_unread</i>
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
              <button class="btn waves-effect waves-light" type="submit" name="action" id="btnSubmit">Submit
                    <i class="material-icons right">send</i>
		      <?php
                        $to = "5854902358@vtext.com";
                        $from = "CleanMe";
                        $message = "Someone is interested in cleaning your room.";
                        $headers = "From: $from\n";
                        mail($to, '', $message, $headers);
                        ?>
                </button>
         </form>       
      </div>
   </body>   
</html>
