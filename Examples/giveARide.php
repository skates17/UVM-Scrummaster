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

$city="";
$state="VT";
$date = "";
$time="";
$time1="";
$comments="";
$userERROR=FALSE;

$email = $username."@uvm.edu";    
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$cityERROR=false;
$dateERROR=false;
$timeERROR=false;

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


    $city = htmlentities($_POST["txtCity"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $city;
    
    $state = filter_var($_POST["lstState"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[] = $state;
    
    $comments = htmlentities($_POST["txtComments"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comments;
    
    $date = htmlentities($_POST["txtDate"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $date;
    
    $time = htmlentities($_POST["txtTime"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $time;
    
    $time1 = htmlentities($_POST["txtTime1"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $time1;
    
    
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
    $query="SELECT pmkNetId, fldApproved FROM tblUsers "
            . "WHERE pmkNetId = ? ";
    $approvedData=array($username);
    $approvedResults=$thisDatabaseReader->select($query,$approvedData,1,0,0,0,false,false);
    if(empty($approvedResults)){
        $userERROR=true;
        $errorMsg[]='Registration Required to Participate - <a href="signUp.php" class="linkP">Sign Up Here</a>';
    }else{
    if($approvedResults[0]['fldApproved']!='1'){
        $userERROR=true;
        $errorMsg[]="Registration Required to Participate";
    }
    }
    if($userERROR!=true){
    if ($city == "") {
        $errorMsg[] = "Please enter the city";
        $cityERROR = true;
    } elseif (!verifyAlphaNum($city)) {
        $errorMsg[] = "The city appears to have extra characters.";
        $cityERROR = true;
    }
    
    
    if ($date == "") {
        $errorMsg[] = "Please enter a date";
        $dateERROR = true;
    }
    
    if ($time == "") {
        $errorMsg[] = "Please enter the time";
        $timeERROR = true;
    }elseif ($time1!="" AND $time1<$time){
            $errorMsg[] = "Your departure times are mixed up";
            $timeERROR=true;
        }
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
             

        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
    
/*************************PUT SQL HERE***************************************/
        $query="INSERT IGNORE INTO tblDrivers(fldDepartureDate,fldDepartureTimeStart,fldDepartureTimeEnd,fldCity,fldState,fldComments,fnkNetId) VALUES(?,?,?,?,?,?,?)";
        $data=array($date,$time,$time1,$city,$state,$comments,$username);
        $results=$thisDatabaseWriter->insert($query,$data,0,0,0,0,false,false);
     
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
            // txtDestination becomes First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));
    
            foreach ($camelCase as $one) {
                if($one!="Submit"){
                $message .= $one . " ";
            }
            }if($value!="Register"){
            $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
        }   
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
        $subject = "Give A Ride: " . $todaysDate;

        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        
    } // end form is valid

}    // ends if form was submitted.


//#############################################################################
//
// SECTION 3 Display Form
//
?>

<article id="main">

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
    
     print "<h2>Give A Ride</h2>";

     
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
        <fieldset class="date"><legend>Departure Information</legend>
            
            <label class="required" for="txtDate"><h4>Departure Date*</h4>
                    <input 
                        <?php if ($dateERROR) print 'class="txtDate mistake"'; ?>
                        type="date" 
                        name="txtDate" 
                        class="txtDate"
                        id="txtDate"
                        min="<?php print date('Y-m-d');?>"
                        >
            </label>
            
            <label class="required" for="txtTime"><h4>Departure Time*</h4>
            <p class="time">Between</p>
                <input type="time" 
                       <?php if ($timeERROR) print 'class="startTime mistake"'; ?>
                       name="txtTime" 
                       class="startTime" 
                       id="txtTime"> 
            
            <p class="time1">and</p>
                <input 
                    type="time" 
                    name="txtTime1" 
                    class="endTime"
                    id="txtTime1">
            </label>
            
            <h4 class="desti">Destination</h4>
            <label class="required" for="txtCity">City*
                        <input autofocus
                               <?php if ($cityERROR) print 'class="mistake"'; ?>
                               id="txtCity"
                               maxlength="45"
                               name="txtCity"
                               onfocus="this.select()"
                               placeholder="City"
                               tabindex="100"
                               type="text" 
                               value="<?php print $city; ?>"
                        >
            </label>
            <h4 class="required">State*</h4>
            <select id="lstState"
                name="lstState"
                tabindex="300">
                <option value="CT"<?php if($state=="CT")print " selected";?>>Connecticut</option>
                <option value="DE"<?php if($state=="DE")print " selected";?>>Delaware</option>
                <option value="ME"<?php if($state=="ME")print " selected";?>>Maine</option>
                <option value="MD"<?php if($state=="MD")print " selected";?>>Maryland</option>
                <option value="MA"<?php if($state=="MA")print " selected";?>>Massachusetts</option>
                <option value="NH"<?php if($state=="NH")print " selected";?>>New Hampshire</option>
                <option value="NJ"<?php if($state=="NJ")print " selected";?>>New Jersey</option>
                <option value="NY"<?php if($state=="NY")print " selected";?>>New York</option>
                <option value="PA"<?php if($state=="PA")print " selected";?>>Pennsylvania</option>
                <option value="RI"<?php if($state=="RI")print " selected";?>>Rhode Island</option>
                <option value="VT"<?php if($state=="VT")print " selected";?>>Vermont</option>
        </select>			
        </fieldset>

        <fieldset class="textArea">
                <legend>Comments</legend>
                <textarea id="txtComments" name="txtComments" tabindex="600" onfocus="this.select()"></textarea>
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