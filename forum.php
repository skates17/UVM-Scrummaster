

<?php 
include "top.php";

$b="SELECT pmkPostId, fnkUsername, fldPhoto, fldPrice, fldComment,fldLocation";
$b.=" FROM tblForum";
$data=array($b);
$info=$thisDatabaseReader->select($b,$data,0,0,0,0, false,false);

foreach($info as $arrayRec){


print'<div class="row">';
	print'<div class="col s12 m6">';
		print'<div class="forumPost card">';
			print'<div class="card-content">';
				print'<div class="heading">';
					print'<span class="card-title">'.$arrayRec['fnkUsername'].'</h2>';
				print'</div>';
				print'<div class="forumPhoto"><img alt="room" src="'.$arrayRec['fldPhoto'].'" height="200px"></div>';
					print'<h4 class = "description">Description:</h4>';
							print'<p>'.$arrayRec['fldComment'].'</p>';
					print'<div class="card-action">';
						print'<a class="price">'.$arrayRec['fldPrice'].'</a>';
						print'<a class="location">'.$arrayRec['fldLocation'].'</a>';
					print'</div>';
				print'</div>';
		print'</div>';
	print'</div>';
print'</div>';
}