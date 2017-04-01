<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/uvm-post-form.css">
</head>
    <?php
    $user = $_COOKIE["netId"];
// define variables and set to empty values
    $title = $disc = $price  = $location = "";
     $titleErr = $discErr = $priceErr = $locationErr ="";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valid = true;
        if (empty($_POST["title"])) {
            $fnameErr = "Yo title  is required";
            $valid = false;
        } else {
            $fname = test_input($_POST["title"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
                $fnameErr = "Only letters and white space allowed";
            }
        }

       

        if (empty($_POST["disc"])) {
            $c = "";
        } else {
            $disc = test_input($_POST["disc"]);
        }

        if (empty($_POST["price"])) {
            $genderErr = "Price is required";
            $valid = false;
        } else {
            $gender = test_input($_POST["price"]);
        }
        
        if (empty($_POST["location"])) {
            $genderErr = "location is required";
            $valid = false;
        } else {
            $gender = test_input($_POST["location"]);
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>
    
    
<?php
  $title = $disc = $price  = $location 
if (isset($_POST['push']) && ($valid)) {
$query = "INSERT INTO 'tblForum' (fnkUsername, fldPrice, fldComment, fldLocation, fldTitle)";
 //    $query = "INSERT INTO tblUsers (-, -, -, -, -)";
//get data from and assign to variables
    $title = $_POST["title"];
    $disc = $_POST['disc'];
    $price = $_POST['price'];
    $location = $_POST["location"];
    $user = $_COOKIE["netId"];

    $values = ' VALUES ("' . $user . ' ","' . $price . ' ","' .  $disc . ' ","' . $location. ' ","' .  $title . '")';
    $query .=$values;
    $results = $thisDatabaseWriter->select($query, "", 0, 0, 10, 0, false, false);


} else {
    ?>

    <?php
}
?>



	<div class="submit-ad ">
		<div class="container">
			<h2 class="uvm-post-head">Service post</h2>
			<div class="uvm-add-post">
				<form>
					<label>Select Category <span>*</span></label>
					<select class="">
					  <option>Select Category</option>
					  <option>something go here</option>
					  <option>Joe can do that for you man!</option>
					  
					 
					</select>
					<div class="clearfix"></div>
					<label>Title   <span>*</span></label>
					<input type="text" class="phone" name="title" placeholder="" value="<?php echo $title; ?>"> <div class="clearfix"></div> <?php echo $titleErr; ?></span>
					
					<label>Description of the service <span>*</span></label>
					<textarea class="mess" name="disc" placeholder="Write few lines about your product" value="<?php echo $disc; ?>" ></textarea>
					<div class="clearfix"></div><?php echo $discErr; ?></span>
					
<!-- 					photo upload -->
				<div class="upload-ad-photos">
				<label>Photos for your add :</label>	
					<div class="photos-upload-view">
						<form id="upload" action="servicePostForm.php" method="POST" enctype="multipart/form-data">

						<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />

						<div>
							<input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
							<div id="filedrag">Or you may  drop files here!</div>
						</div>

						<div id="submitbutton">
							<button type="submit">Upload Files</button>
						</div>

						</form>

						<div id="messages">
						<p>Status Messages</p>
						</div>
						</div>
					<div class="clearfix"></div>
						<script src="js/dropfile.js"></script>
				</div>
					<div class="personal-details">
					<form>
					
						<label>Price <span>*</span></label>
						<input type="text" class="name" name="price" placeholder="$$$$$" value="<?php echo $price; ?>">
						<div class="clearfix" ></div>
						
						<label>Location <span>*</span></label>
						<input type="text" class="name" name="location" placeholder="" value="<?php echo $location; ?>">
						<div class="clearfix"></div>

					<input type="submit" name="push" value="POST">					
					<div class="clearfix"></div>
					</form>
					</div>
			</div>
		</div>	
	</div>
	    <?php
}
?>
</html>