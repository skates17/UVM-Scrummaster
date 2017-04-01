<?php
include "top.php";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1 Initialize variables
//
// SECTION: 1a.
// We print out the post array so that we can see our form is working.
// if ($debug){  // later you can uncomment the if statement
    //print "<p>Post Array:</p><pre>";
   // print_r($_POST);
  //  print "</pre>";
// }

//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.

$thisURL = $domain . $phpSelf;


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form

$Name = "";

$email = $username."@uvm.edu";    

$style = "Cleanee";

$nice=true;
$good=false;
$goodMusic=false;
$fun=false;

$badCleaner=false;
$mean=false;
$late=false;
$uncomfortable=false;

$rating="5";

$totalChecked = 0;

$comments="";
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$NameERROR = false;

$userERROR = false;

$emailERROR = false;
$styleERROR=false;
////%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1e misc variables
//
// create array to hold error messages filled (if any) in 2d displayed in 3c.
$errorMsg = array(); 
 
// array used to hold form values that will be written to a CSV file
$dataRecord = array();

// have we mailed the information to the user?
$mailed=false;

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//
if (isset($_POST["btnSubmit"])) {

    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2a Security
    // 
//    if (!securityCheck($thisURL)) {
//        $msg = "<p>Sorry you cannot access this page. ";
//        $msg.= "Security breach detected and reported.</p>";
//        die($msg);
//    }
        
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2b Sanitize (clean) data 
    // remove any potential JavaScript or html code from users input on the
    // form. Note it is best to follow the same order as declared in section 1c.

    $Name = htmlentities($_POST["txtName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $Name;
    
    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comments;
    
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[] = $email;

    $style = htmlentities($_POST["radType"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $style;
    
    $rating=  htmlentities($_POST["star"], ENT_QUOTES, "UTF-8");
    $dataRecord[]= $rating;
    
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2c Validation
    //
    // Validation section. Check each value for possible errors, empty or
    // not what we expect. You will need an IF block for each element you will
    // check (see above section 1c and 1d). The if blocks should also be in the
    // order that the elements appear on your form so that the error messages
    // will be in the order they appear. errorMsg will be displayed on the form
    // see section 3b. The error flag ($emailERROR) will be used in section 3c.
    if ($Name == "") {
        $errorMsg[] = "Please enter the reviewee's email address";
        $NameERROR = true;
    } elseif (!verifyEmail($Name)) {
        $errorMsg[] = "Reviewee's email appears to be incorrect";
        $NameERROR = true;
    }
    
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    } 
    
    if (isset($_POST["chk1"])) {
        $nice = true;
    } else {
        $nice = false;
    }
    $dataRecord[] = $nice;
    
    if (isset($_POST["chk2"])) {
        $fun = true;
    } else {
        $fun = false;
    }
    $dataRecord[] = $fun;
   
    if (isset($_POST["chk3"])) {
        $goodCleaner = true;
    } else {
        $goodCleaner = false;
    }
    $dataRecord[] = $goodCleaner;
    
    if (isset($_POST["chk4"])) {
        $goodMusic = true;
    } else {
        $goodMusic = false;
    }
    $dataRecord[] = $goodMusic;
    if (isset($_POST["chk5"])) {
        $badCleaner = true;
    } else {
        $badCleaner = false;
    }
    $dataRecord[] = $badCleaner;
    if (isset($_POST["chk6"])) {
        $uncomfortable = true;
    } else {
        $uncomfortable = false;
    }
    $dataRecord[] = $uncomfortable;
    if (isset($_POST["chk7"])) {
        $mean = true;
    } else {
        $mean = false;
    }
    $dataRecord[] = $mean;
    if (isset($_POST["chk8"])) {
        $late = true;
    } else {
        $late = false;
    }
    $dataRecord[] = $late;
    
    
     $query="SELECT pmkNetId, fldApproved FROM tblUsers "
            . "WHERE pmkNetId = ? ";
    $approvedData=array($username);
    $approvedResults=$thisDatabaseReader->select($query,$approvedData,1,0,0,0,false,false);
    if($approvedResults[0]['fldApproved']!='1' OR empty($approvedData)){
        $userERROR=true;
        $errorMsg[]="Registration Required to Participate";
    }
    //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    //
    // SECTION: 2d Process Form - Passed Validation
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //    
  
    if (!$errorMsg) {
        if ($debug)
            print "<p>Form is valid</p>";
        $nice1="";
        $goodCleaner1="";
        $goodMusic1="";
        $fun1="";
        $badCleaner1="";
        $uncomfortable1="";
        $mean1="";
        $late1="";
        
        if($nice==FALSE){
            $nice1='0';
        }
        else{
            $nice1='1';
        }
        if($goodCleaner==FALSE){
            $goodCleaner1='0';
        }
        else{
            $goodCleaner1='1';
        }
        if($goodMusic==FALSE){
            $goodMusic1='0';
        }
        else{
            $goodMusic1='1';
        }
        if($fun==FALSE){
            $fun1='0';
        }
        else{
            $fun1='1';
        }
        if($badCleaner==FALSE){
            $badCleaner1='0';
        }
        else{
            $badCleaner1='1';
        }
        if($mean==FALSE){
            $mean1='0';
        }
        else{
            $mean1='1';
        }
        if($late==FALSE){
            $late1='0';
        }
        else{
            $late1='1';
        }
        if($uncomfortable==FALSE){
            $uncomfortable1='0';
        }
        else{
            $uncomfortable1='1';
        }
        
        $status="";
        if ($style=='Passenger'){
            $status='1';
        }
        elseif($style=='Cleaner'){
            $status='2';
        }
        $reviewee=  explode("@", $Name);
        $revieweeId=$reviewee[0];
        
//         $query="INSERT IGNORE INTO tblReviews(fldStatus, fldRating, fldComments, fldNice, fldFunny, fldGoodCleaner, fldGoodMusic, fldBadCleaner, fldUncomfortable, fldMean, fldLate, fnkNetId,fnkRevieweesNetId) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
//         $data=array($status,$rating,$comments,$nice1,$fun1,$goodCleaner1,$goodMusic1,$badCleaner1,$uncomfortable1,$mean1,$late1, $username, $revieweeId);
//         $results=$thisDatabaseWriter->insert($query,$data,0,0,0,0,FALSE,FALSE);
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2e Save Data
  
     
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to mail
        // to the person filling out the form (section 2g).

        $message = '<h2>Your information.</h2>';
    
        foreach ($_POST as $key => $value) {
            $message .= "<p>";
            
            // breaks up the form names into words. for example
            // txtName becomes First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));
    
            foreach ($camelCase as $one) {
                $message .= $one . " ";
            }

            $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
        }   
    
    
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2g Mail to user
        //
        // Process for mailing a message which contains the forms data
        // the message was built in section 2f.
        $to = $email; // the person who filled out the form
        $cc = "";
        $bcc = "jpornelo@uvm.edu";

        $from = "CatchaRide <noreply@yoursite.com>";

        // subject of mail should make sense to your form
        $todaysDate = strftime("%x");   
        $subject = "Review: " . $todaysDate;

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        
    } // end form is valid

}    // ends if form was submitted.


//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <?php
    //####################################
    //
    // SECTION 3a. 
    // 
    // If its the first time coming to the form or there are errors we are going
    // to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit 
        print "<h2>Thank you for providing your information.</h2>";
    
        print "<p>For your records a copy of this data has ";
    
        if (!$mailed) {
            print "not ";
        }
        print "been sent:</p>";
        print "<p>To: " . $email . "</p>";
    
        print $message;
    } else {
    
     print "<h2>Reviews</h2>";

     
        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form
   
    if ($errorMsg) {
        print '<div id="errors">' . "\n";
        print "<h2>Your form has the following mistakes that need to be fixed.</h2>\n";
        print "<ol>\n";
        
        foreach ($errorMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        
        print "</ol>\n";
        print "</div>\n";
    }

        //####################################
        //
        // SECTION 3c html Form
        //
        /* Display the HTML form. note that the action is to this same page. $phpSelf
            is defined in top.php
            NOTE the line:
            value="<?php print $email; ?>
            this makes the form sticky by displaying either the initial default value (line ??)
            or the value they typed in (line ??)
            NOTE this line:
            <?php if($emailERROR) print 'class="mistake"'; ?>
            this prints out a css class so that we can highlight the background etc. to
            make it stand out that a mistake happened here.
       */
    ?>

    <form action="<?php print $phpSelf; ?>"
          id="frmRegister"
          method="post">
                <fieldset class="radio">
                    <legend>Preference</legend>
                    Are you Reviewing the Cleaner or Passenger?
        
                            <br>
                            <label class="rad"><input type="radio"
                                          class="radType"
                                          name="radType"
                                          value="Passenger"
                                          <?php if ($style == "Passenger") print 'checked' ?>
                                          tabindex="330"/>Passenger</label>
                            <label class="rad"><input type="radio"
                                          class="radType"
                                          name="radType"
                                          value="Cleaner"
                                          <?php if ($style == "Cleaner") print 'checked' ?>
                                          tabindex="340">Cleaner</label>
                </fieldset>
                <fieldset class="text">
                    <legend>Contact Information</legend>

                    <label class="required" for="txtName">Reviewee's Email*
                        <br>
                        <input autofocus
                               <?php if ($NameERROR) print 'class="mistake"'; ?>
                               id="txtName"
                               maxlength="45"
                               name="txtName"
                               onfocus="this.select()"
                               placeholder="Reviewee's Email"
                               tabindex="100"
                               type="text" 
                               value="<?php print $Name; ?>"
                        >
                    </label>                  
                    
                    <label class="required" for="txtEmail">Your Email*
                        <br>
                        <input 
                               <?php if ($emailERROR) print 'class="mistake"'; ?>
                               id="txtEmail"
                               maxlength="45"
                               name="txtEmail"
                               onfocus="this.select()"
                               placeholder="Enter a valid email address"
                               tabindex="120"
                               type="text"
                               value="<?php print $email; ?>"
                               readonly
                        >
                    </label>
                    
                    
                </fieldset> <!-- ends contact -->
                
                <fieldset class="rating">
                    <legend>Rating</legend>
                <div class="stars">
                    <input class="star star-5" id="star-5" type="radio" name="star" value="5" <?php if ($rating == "5") print 'checked' ?>/>
                    <label class="star star-5" for="star-5"></label>
                    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                    <label class="star star-4" for="star-4"></label>
                    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                    <label class="star star-1" for="star-1"></label>
                </div>
                </fieldset>
                
                
                
                <fieldset class="textArea">
                    
                    
                    <legend>Comments</legend>
                <textarea id="txtComments" name="txtComments" tabindex="600" onfocus="this.select()"></textarea>
                </fieldset>
                
                <fieldset class="checkbox <?php if ($activityERROR) print ' mistake'; ?>">
                    <legend>Description</legend>
                            <h4>Good Qualities</h4>
                          
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk1"
                                    value="nice"
                                    <?php if($nice) print'checked';?>
                                    tabindex="500">Nice</label>
                            
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk2"
                                    value="funny"
                                    <?php if($fun) print'checked';?>
                                    tabindex="510">Funny</label>
   
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk3"
                                    value="goodCleaner"
                                    <?php if($goodCleaner) print'checked';?>
                                    tabindex="520">Good Cleaner</label>
                            
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk4"
                                    value="goodMusic"
                                    <?php if($goodMusic) print'checked';?>
                                    tabindex="530">Good Music</label>
                            
                            <h4>Bad Qualities</h4>
                          
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk5"
                                    value="badCleaner"
                                    <?php if($badCleaner) print'checked';?>
                                    tabindex="540">Bad Cleaner</label>
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk6"
                                    value="uncomfortable"
                                    <?php if($uncomfortable) print'checked';?>
                                    tabindex="540">Uncomfortable</label>
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk7"
                                    value="mean"
                                    <?php if($mean) print'checked';?>
                                    tabindex="540">Mean</label>
                            <label class="chk"><input type="checkbox"
                                    id="checkbox"
                                    name="chk8"
                                    value="late"
                                    <?php if($late) print'checked';?>
                                    tabindex="540">Late</label>
                            </fieldset>
                
            <fieldset class="buttons">
                <legend></legend>
                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register" >
            </fieldset> <!-- ends buttons -->
    </form>

    <?php 
    } // end body submit
    ?>   

</article>

<?php include "footer.php"; ?>

</body>
</html>