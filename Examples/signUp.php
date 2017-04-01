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

$firstName = "";

$lastName = "";

$city = "Burlington";

$state="VT";

$zip="";

$email = $username."@uvm.edu";    

$phone= "";


//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;

$lastNameERROR = false;

$emailERROR = false;

$zipERROR = false;

$phoneERROR = false;

$cityERROR=false;

$userERROR=false;

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

    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    
    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;
    
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[] = $email;

    $city = filter_var($_POST["txtCity"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[] = $city;
    
    $state = filter_var($_POST["lstState"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[] = $state;
    
    $zip = filter_var($_POST["txtZip"], FILTER_SANITIZE_EMAIL);    
    $dataRecord[] = $zip;
    
    $phone = filter_var($_POST["txtPhone"], FILTER_SANITIZE_EMAIL); 
    $phone = implode(array_filter(str_split($phone,1),"is_numeric"));
    $dataRecord[] = $phone;
    
    //$type = htmlentities($_POST["lstBeer"], ENT_QUOTES, "UTF-8");
    //$dataRecord[] = $type;
    
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
    
    if ($firstName == "") {
        $errorMsg[] = "Please enter your first name";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "Your first name appears to have extra characters.";
        $firstNameERROR = true;
    }
    
    if ($lastName == "") {
        $errorMsg[] = "Please enter your last name";
        $lastNameERROR = true;
    } elseif (!verifyAlphaNum($lastName)) {
        $errorMsg[] = "Your last name appears to have extra character.";
        $lastNameERROR = true;
    }
    if($city==""){
        $errorMsg[]="Please enter a city";
        $cityERROR=true;
    }elseif(!verifyAlphaNum($city)){
        $errorMsg[]="The city appears to have extra characters.";
    }
    
    if ($email == "") {
        $errorMsg[] = "Please enter your email address";
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = "Your email address appears to be incorrect.";
        $emailERROR = true;
    } 
    if(!verifyNumeric($zip)){
        $errorMsg[] = "Zip code has illegal characters.";
        $zipERROR = true;
    }
    if(!verifyPhone($phone)){
        $errorMsg[] = "Phone number appears to be invalid.";
        $phoneERROR = TRUE;
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
    $query="INSERT IGNORE INTO tblUsers(pmkNetId, fldFirstName, fldLastName, fldCity, fldState, fldZip, fldEmail, fldPhone) VALUES(?,?,?,?,?,?,?,?)";
    $data=array($username,$firstName,$lastName,$city,$state,$zip,$email,$phone);
    $results=$thisDatabaseWriter->insert($query,$data,0,0,0,0,false,false);
        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2e Save Data
        //
        // This block saves the data to a CSV file.   

        
     
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
            // txtFirstName becomes First Name
            $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));
    
            foreach ($camelCase as $one) {
                if($one!="Submit"){
                    $message .= $one . " ";
                }
            }
            if($value!="Register"){
                $message .= " = " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
            }
        }   
        $message.= '<a href="http:'.DOMAIN.$PATH_PARTS["dirname"].'/confirmation.php">Confirm Registration</a>';
    
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
        $subject = "Sign Up: " . $todaysDate;

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
        print "<p class='output'>For your records a copy of this data has ";
    
        if (!$mailed) {
            print "not ";
        }
        print "been sent</p>";
        print "<p class='output'>to " . $email . "</p>";
    
        print $message;
    } else {
    
     print "<h2>Registration</h2>";
        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form
   
    if ($errorMsg) {
        print '<div id="errors">' . "\n";
        print "<h2>Your form has the following mistakes that need to be fixed.</h2>\n";
        print "<ol>\n";
        print $phone;
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
                <fieldset class="text">
                    <legend>Name</legend>
                    
                    <label class="required" for="txtFirstName">First Name*<br>
                        <input autofocus
                               <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                               id="txtFirstName"
                               maxlength="45"
                               name="txtFirstName"
                               onfocus="this.select()"
                               placeholder="Enter your first name"
                               tabindex="100"
                               type="text" 
                               value="<?php print $firstName; ?>"
                        >
                    </label>                  
                    
                    <label class="required" for="txtLastName">Last Name*<br>
                        <input 
                               <?php if ($lastNameERROR) print 'class="mistake"'; ?>
                               id="txtLastName"
                               maxlength="45"
                               name="txtLastName"
                               onfocus="this.select()"
                               placeholder="Enter your last name"
                               tabindex="400"
                               type="text" 
                               value="<?php print $lastName; ?>"
                        >
                    </label>
                </fieldset>
                <fieldset class="text">
                    <legend>Home Address</legend>
                    <label class="required" for="txtCity">City<br>
                        <input 
                               id="txtCity"
                               maxlength="45"
                               name="txtCity"
                               onfocus="this.select()"
                               placeholder="City"
                               tabindex="500"
                               type="text" 
                               value="<?php print $city; ?>"
                        >
                    </label>
                    
                    <label class="required" for="lstState">State<br>
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
                    </label>
                    <label class="required" for="txtZip">Zip Code<br>
                        <input 
                               <?php if ($zipERROR) print 'class="mistake"'; ?>
                               id="txtZip"
                               maxlength="45"
                               name="txtZip"
                               onfocus="this.select()"
                               placeholder="Zip Code"
                               tabindex="700"
                               type="text" 
                               value="<?php print $zip; ?>"
                        >
                    </label>
                    
                </fieldset> <!-- ends contact -->
                <fieldset class="text">
                    <legend>Contact Information</legend>
                    <label class="required" for="txtEmail">Email*<br>
                        <input 
                               <?php if ($emailERROR) print 'class="mistake"'; ?>
                               id="txtEmail"
                               maxlength="45"
                               name="txtEmail"
                               onfocus="this.select()"
                               placeholder="Enter a valid email address"
                               tabindex="800"
                               type="text"
                               value="<?php print $email; ?>"
                               readonly
                        >
                    </label>
                    <label class="required" for="txtPhone">Phone Number<br>
                        <input 
                               <?php if ($phoneERROR) print 'class="mistake"'; ?>
                               id="txtPhone"
                               maxlength="45"
                               name="txtPhone"
                               onfocus="this.select()"
                               placeholder="Phone Number"
                               tabindex="900"
                               type="text"
                               value="<?php print $phone; ?>"
                        >
                    </label>
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
