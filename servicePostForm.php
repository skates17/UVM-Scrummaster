<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/uvm-post-form.css">
</head>


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
					<label>title   <span>*</span></label>
					<input type="text" class="phone" placeholder="">
					<div class="clearfix"></div>
					<label>Description of the service <span>*</span></label>
					<textarea class="mess" placeholder="Write few lines about your product"></textarea>
					<div class="clearfix"></div>
				<div class="upload-ad-photos">
				<label>Photos for your add :</label>	
					<div class="photos-upload-view">
						<form id="upload" action="index.html" method="POST" enctype="multipart/form-data">

						<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />

						<div>
							<input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
							<div id="filedrag">or you may  drop files here!</div>
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
				
				
					<input type="submit" value="Post">					
					<div class="clearfix"></div>
					</form>
					</div>
			</div>
		</div>	
	</div>
	
</html>