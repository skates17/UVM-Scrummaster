<?php

$a = "'".$_COOKIE["netId"]."'";
$getinfo = "SELECT * FROM tblUser WHERE pmkUsername = 'aram1'";
$info = $thisDatabaseReader->select($getinfo,"", 1, 0, 2, 0, false, false);

$firstName=$info[0]['fldFirstName'];
$lastName=$info[0]['fldLastName'] ;

$firstName = "";
$lastName = "";
$telephone = "";
$address = "";
$cleaner = false;
$cleanee = false;

$dataRecord = array();

if (isset($_POST["btnSubmit"])) {
    
    
    if (isset($_POST["firstName"])) {
    $dataRecord[]=$_POST["firstName"];
    $firstName = $_POST["firstName"];

}
    if (isset($_POST["lastName"])) {
    $dataRecord[]=$_POST["lastName"];
    $lasyName = $_POST["lastName"];

}
    if (isset($_POST["telephone"])) {
    $dataRecord[]=$_POST["telephone"];
    $telephone = $_POST["telephone"];

}
    if (isset($_POST["address"])) {
    $dataRecord[]=$_POST["address"];
    $address= $_POST["address"];
}
    if (isset($_POST["cleaner"])) {
    $cleaner=true;
    $dataRecord[]=$_POST["cleaner"];
    
    }
    if (isset($_POST["cleanee"])) {
    $cleanee=true;
    $dataRecord[]=$_POST["cleanee"];
    
    }
    
   foreach($dataRecord as $key => $value){
       //echo '<p>'.$value.'</p>';

}
}

else{

$telephone=$info[0]['fldPhone'];
$address= $info[0]['fldLocation'];
$cleaner=false;
$cleanee=false;
}

$pmkUsername = $_COOKIE['netId'];
array_push($dataRecord, $pmkUsername);
$insertInfo = 'UPDATE `tblUser` SET fldPhone = ?, fldLocation = ?, fldCleaner = 1 WHERE `pmkUsername` = ?';
$addInfo = $thisDatabaseWriter->insert($insertInfo, $dataRecord, 1, 0, 0, 0, false, false);
//print_r($dataRecord);
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

       
       <h1>Edit your information below:</h1>
       
          
             
          
          
          
          
        <div class="row"> 
            <form method ="POST" class="col s12">
        <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">account_circle</i>
          <input id="first_name" value="<?php print $firstName  ?>" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" value="<?php print $lastName ?>" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>    
       <div class="row">
        <div class="input-field col s6">
          <i class="material-icons prefix">phone</i>
          <input id="telephone" name="telephone" type="tel" class="validate" value = "<?php print $telephone ?>">
          <label for="telephone">Telephone</label>
        </div>
           
               <div class="input-field col s6">
                   <i class="material-icons prefix">mark_unread</i>
                  <textarea name ="address" id="address" class="materialize-textarea" value = "<?php print $address ?>"></textarea>
                  <label for="address">Address</label>
               </div>
        </div>			
           
            <div class="row">
               <div class="input-field col s6">
                   <p>
                     <input name="job" id="cleaner" type="radio" value="cleaner" checked>
                     <label for="cleaner">Cleaner</label>
                  </p>
                  <p>
                     <input name="job" id="cleanee" type="radio" value="cleanee">
                     <label for="cleanee">Cleanee</label>
                  </p>
                  <p>

                  </p>
               </div>
                
               
        

                
            </div>  
              <input class="btn waves-effect waves-light" type="submit" name="btnSubmit" id="btnSubmit" value="Update">
<!--                    <i class="material-icons right">send</i>-->
		      <?php
//		      	$to = $telephone."@vtext.com";
//                        $from = "CleanMe";
//                        $message = "Someone is interested in cleaning your room.";
//                        $headers = "From: $from\n";
//                        mail($to, '', $message, $headers);
                       ?>
                </button>
   
         </form>       
      </div>
   </body>   
</html>