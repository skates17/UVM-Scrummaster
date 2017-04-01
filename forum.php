<<<<<<< HEAD

<?php 
include "top.php";
=======
<?php include 'top.php';
>>>>>>> c36b8fa7bd37851de7769ec609515f351a7aa4e6
$b="SELECT pmkPostId, fnkUsername, fldPhoto, fldPrice, fldComment,fldLocation";
$b.=" FROM tblForum";
$data=array($b);
$info=$thisDatabaseReader->select($b,$data,0,0,0,0, false,false);

foreach($info as $arrayRec){
	print '<div class="forumPost">';
	print'<div class="heading">';
	print'<h2 class="forumH2Left">'.$arrayRec['fnkUsername'].'</h2>';
	print'</div>';
	print'<div class="forumPhoto"><img alt="room" src="'.$arrayRec['fldPhoto'].'" width="100">';
	print'<h4 class = "description">Description</h4>';
	print'<p>'.$arrayRec['fldComment'].'</p>';
	print'<p class="price">'.$arrayRec['fldPrice'].'</p>';
	print'<p class="Location">'.$arrayRec['fldLocation'].'</div>';
	print'</div>';
}
	?>

<div class="row">
	<div class="col s12 m6">
		<div class="forumPost card">
			<div class="card-content">
				<div class="heading">
					<span class="card-title">NetId</h2>
				</div>
				<div class="forumPhoto"><img alt="room" src="example.jpg" height="200px"></div>
					<h4 class = "description">Description:</h4>
					<p>I have a dirty room, someone needs to clean it because I am lazy and grew up with a maid so I don't know how to clean. Hurry up and do a good job and I'll give you a quarter tip so you can buy yourself something nice.</p>
					<div class="card-action">
						<a class="price">Price</a>
						<a class="location">Location</a>
					</div>
				</div>
		</div>
	</div>
</div>