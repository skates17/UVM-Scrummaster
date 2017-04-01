<?php


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//
// SECTION: 2 Process for when the form is submitted
//


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
    
     print "<h3>Fill out</h3>";

     
        //####################################
        //
        // SECTION 3b Error Messages
        //
        // display any error messages before we print out the form
   
    if ($errorMsg) {
        print '<div id="errors">' . "\n";
        print$other;
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




print'<form action="'.$phpSelf.'"
          id="frmRegister"
          method="post">
          <fieldset class="date"><legend>Departure Information</legend>
            
            <label class="required" for="txtTime"><h4>Preferred Departure Time*</h4>
                <input type="time"';
                       if ($timeERROR) {print 'class="startTime mistake"'; }
                       print'name="txtTime" 
                       class="startTime" 
                       id="txtTime"> 
            </label>
            
            <h4 class="desti">Destination</h4>
            <label class="required" for="txtDestination">Street Address*
                        <input autofocus ';
                               if ($destinationERROR) {print 'class="mistake"';}
                               print'id="txtDestination"
                               maxlength="45"
                               name="txtDestination"
                               onfocus="this.select()"
                               placeholder="Enter your destination"
                               tabindex="100"
                               type="text" 
                               value="'.$destination.'"
                        >
            </label>
            <label class="required" for="txtCity">City*
                        <input autofocus ';
                               if ($cityERROR){ print 'class="mistake"';}
                               print'id="txtCity"
                               maxlength="45"
                               name="txtCity"
                               onfocus="this.select()"
                               placeholder="City"
                               tabindex="100"
                               type="text" 
                               value="'.$city.'"
                        >
            </label>
            <label class="required" for="txtState">State*
                        <input autofocus ';
                               if ($stateERROR){ print 'class="mistake"';}
                               print'id="txtState"
                               maxlength="45"
                               name="txtState"
                               onfocus="this.select()"
                               placeholder="State"
                               tabindex="100"
                               type="text" 
                               value="'.$state.'"
                        >
            </label>
        </fieldset>
        
        <fieldset class="lists">
            <legend>Pickup Information</legend>
            <h4 class="required">Pickup Location*</h4>
             <script type="text/javascript">
                function showfield(name){
                    if(name=="Other"){
                    var boxes = document.querySelectorAll(".hide1");
                    for(var i=0;i<boxes.length;i++){
                        boxes[i].style.display="block";
                    }
                    }
                }
            </script>

            <select id ="lstPickup"
                name="lstPickup"
                tabindex="400"
                onchange="showfield(this.options[this.selectedIndex].value)">
                <optgroup label="Athletic Campus">
                    <option';if($type=="Harris Millis"){print " selected ";}
                        print'value="Harris Millis">Harris Millis</option>

                    <option'; if($type=="Living/Learning"){print " selected ";}
                       print ' value="Living/Learning">Living/Learning</option>

                    <option'; if($type=="Marsh"){print " selected ";}
                       print' value="Marsh">Marsh, Austin, or Tupper Hall</option>

                    <option'; if($type=="uHeightsN"){print " selected ";}
                        print ' value="UHeights North">University Heights North</option>

                    <option'; if($type=="uHeightsS"){print " selected ";}
                        print ' value="UHeights South">University Heights South</option>
                </optgroup>
                
                <optgroup label="Central Campus">
                    <option'; if($type=="Converse"){print " selected ";}
                        print ' value="Converse">Converse Hall</option>
                </optgroup>
                
                <optgroup label="North Campus">
                    <option'; if($type=="Jeane Mance"){print " selected ";}
                        print ' value="Jeane Mance">Jeanne Mance Hall</option>
                    <option'; if($type=="Trinity"){print " selected";}
                        print ' value="Trinity">Trinity Campus</option>
                </optgroup>
                
                <optgroup label="Redstone Campus">
                    <option'; if($type=="Redstone Apartments"){print " selected ";}
                        print ' value="Redstone Apartments">Redstone Apartments</option>

                    <option'; if($type=="Redstone Lofts"){print " selected ";}
                        print ' value="Redstone Lofts">Redstone Lofts</option>

                    <option'; if($type=="Davis"){print " selected ";}
                        print ' value="Davis">Wing, Davis, or Wilks Hall</option>

                    <option'; if($type=="Simpson"){print " selected ";}
                        print ' value="Simpson">Mason, Simpson, or Hamilton Hall</option>

                    <option'; if($type=="Christie"){print " selected ";}
                        print ' value="Christie">Christie, Wright, Patterson, or Slade Hall</option>
                </optgroup>
                
                <optgroup label="Other">
                    <option'; if($type=="Quarry Hill"){print " selected ";}
                        print ' value="Quarry Hill">Quarry Hill</option>

                    <option'; if($type=="Sheraton"){print " selected ";}
                        print ' value="Sheraton">Sheraton</option>

                    <option'; if($type=="Other"){print" selected ";}
                        print ' value="Other">Other</option>
                </optgroup>
                </select>
            
            <div id="hide1" class="hide1" style="display:none; ">
                <label class="required" for="txtOther"><h4 class="required">Other*</h4>
                        <input autofocus ';
                               if ($destinationERROR){ print 'class="mistake"'; }
                               print'id="txtOther"
                               maxlength="45"
                               name="txtOther"
                               onfocus="this.select()"
                               placeholder="Pickup Location"
                               tabindex="100"
                               type="text" 
                               value="'.$other.'"';
                        print'>
            </label>
            </div>
            
            
            
            

        </fieldset>
        <fieldset class="textArea">
                    
                    
                    <legend>Comments</legend>
                <textarea id="txtComments" name="txtComments" tabindex="600" onfocus="this.select()"></textarea>
        </fieldset>
                
            <fieldset class="buttons">
                <legend></legend>
                <input class="button" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register" >
            </fieldset> <!-- ends buttons -->
    </form>';
    }?>