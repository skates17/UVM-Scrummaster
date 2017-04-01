<?php

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
       // echo '<p>' . $value . '</p>';
    }
}

$pmkUsername = $_COOKIE['netId'];

array_push($dataRecord, $pmkUsername);
$insertInfo = 'UPDATE `tblUser` SET fldPhone = ?, fldLocation = ?, fldCleaner = ? WHERE `pmkUsername` = ?';
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
<?php
        
$a=$_COOKIE["netId"];
$reviewQuery="SELECT pmkReviewId, fldStatus, fldRating, fldComments, fldNice, fldFunny, fldGoodCleaner, fldGoodMusic, fldBadCleaner, fldUncomfortable, fldMean, fldLate, fnkNetId, fnkRevieweesNetId, fldApproved";
$reviewQuery.=" FROM tblReviews WHERE fnkRevieweesId= ?" ;
$data=array($a);
$QueryInfo=$thisDatabaseReader->select($reviewQuery, $data,1,1,0,0,false,false);
?>
<div class="page">
<?php
if(!empty($QueryInfo)){
    print'<h2 class="home">Reviews of You!</h2>';
        
        foreach ($QueryInfo as $arrayRec){
            if($arrayRec['fldApproved']=='-1' AND $i==0){
                print'<h2 class="home">Pending Reviews</h2>';
            }
            if($arrayRec['fldApproved']=='0' AND $j==0){
                print'<h2 class="home">Declined Reviews</h2>';
                $j++;
            }
            print'<div id="review" class="review">';
            print'<div class="heading">';
            print'<h5 class="heading">'.$arrayRec['fnkRevieweesNetId'].'</h5><h6 class=status>';
            if($arrayRec['fldStatus']=='1'){
                print ' - Cleanee';
            }
            else{
                print' - Cleaner';
            }
            print'</h6>';
            print'</div>';
            print'<div class = "reviewLeft">';
            
            print'<img id="ratingPic" src="images/'.$arrayRec['fldRating'].'Star.png"/>';
            print'<div class="divAttrib">';
            if($arrayRec['fldNice']=="1"){
                print'<p class="attributes">Nice</p>';
            }
            if($arrayRec['fldFunny']=="1"){
                print'<p class="attributes">Funny</p>';
            }
            if($arrayRec['fldGoodCleaner']=="1"){
                print'<p class="attributes">Good Cleaner</p>';
            }
            if($arrayRec['fldGoodMusic']=="1"){
                print'<p class="attributes">Good Music</p>';
            }
            if($arrayRec['fldBadCleaner']=="1"){
                print'<p class="attributes">Bad Cleaner</p>';
            }
            if($arrayRec['fldUncomfortable']=="1"){
                print'<p class="attributes">Uncomfortable</p>';
            }
            if($arrayRec['fldMean']=="1"){
                print'<p class="attributes">Mean</p>';
            }
            if($arrayRec['fldLate']=="1"){
                print'<p class="attributes">Late</p>';
            }
            print'</div>';
            print'</div>';
            print'<div class = "reviewRight">';
            print'<h4 class="commentsRev">Comments</h4>';
            print'<p class = "commentReview">'.$arrayRec['fldComments'].'</p>';
            print'</div>';
            print'<div class="reviewBottom">';
            print'<h4 class="reviewBot">-'.$arrayRec['fnkNetId'].'</h4>';
            print'</div>';
            
            print'</div>';
        }
}?>

<hr>

</div>
    </div>
</body>   
</html>
