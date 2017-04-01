<?php
include top . php;


$firstName = "";
$lastName = "";
$telephone = "";
$address = "";
$cleaner = false;
$cleanee = false;

$dataRecord = array();

if (isset($_POST["btnSubmit"])) {


    if (isset($_POST["firstName"])) {
        $dataRecord[] = $_POST["firstName"];
    }
    if (isset($_POST["lastName"])) {
        $dataRecord[] = $_POST["lastName"];
    }
    if (isset($_POST["telephone"])) {
        $dataRecord[] = $_POST["telephone"];
    }
    if (isset($_POST["address"])) {
        $dataRecord[] = $_POST["address"];
    }
    if (isset($_POST["cleaner"])) {
        $cleaner = true;
        $dataRecord[] = $_POST["cleaner"];
    }
    if (isset($_POST["cleanee"])) {
        $cleanee = true;
        $dataRecord[] = $_POST["cleanee"];
    }

    foreach ($dataRecord as $key => $value) {
        echo '<p>' . $value . '</p>';
    }
}

$pmkUsername = $_COOKIE['netId'];

array_push($dataRecord, $pmkUsername);
$insertInfo = 'UPDATE `tblUser` SET fldPhone = ?, fldLocation = ?, fldCleaner = ? WHERE `pmkUsername` = ?';
$addInfo = $thisDatabaseWriter->insert($insertInfo, $dataRecord, 1, 0, 0, 0, false, false);
print_r($dataRecord);

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

        <h1>Edit your information below:</h1
        <form method ="POST" class="col s12" action="register.php">
            <div class="row">  
                <div class="row">
                    <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="first_name" value="Alvin" type="text" class="validate">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field col s6">
                        <i class="material-icons prefix">supervisor_account</i>
                        <input id="last_name" value="Chipmunks" type="text" class="validate">
                        <label for="last_name">Last Name</label>
                    </div>
                </div>    
                <div class="row">

                    <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="telephone" name="telephone" type="tel" class="validate">
                        <label for="telephone">Telephone</label>
                    </div>

                    <div class="input-field col s6">
                        <i class="material-icons prefix">markunread_mailbox</i>
                        <input id="address" name="address" type="text" class="validate">
                        <label for="address">Address</label>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <p>
                                <input name="job" id="cleaner" type="radio" value="cleaner">
                                <label for="cleaner">Cleaner</label>
                            </p>
                            <p>
                                <input name="job" id="cleanee" type="radio" value="cleanee">
                                <label for="cleanee">Cleanee</label>
                            </p>
                            <p>

                            </p>
                            <button class="btn waves-effect waves-light" type="submit" name="btnSubmit" id="btnSubmit">Update
                            <i class="material-icons right">update</i>
                            <?php
                            $to = $telephone . "@vtext.com";
                            $from = "CleanMe";
                            $message = "Someone is interested in cleaning your room.";
                            $headers = "From: $from\n";
                            mail($to, '', $message, $headers);
                            ?>
                        </button>
                        </div>
                        

                    </div>  

                </div>			
            </div>


        </form>       
    </div>
</body>   
</html>
