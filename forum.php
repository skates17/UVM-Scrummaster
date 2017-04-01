

<?php 

$b="SELECT pmkPostId, fnkUsername, fldPhoto, fldPrice, fldComment,fldLocation";
$b.=" FROM tblForum";
$data=array($b);
$info=$thisDatabaseReader->select($b,$data,0,0,0,0, false,false);

foreach($info as $arrayRec){


//print'<div class="row">';
	print'<div class="col s12 m4">';
		print'<div class="forumPost card">';
			print'<div class="card-content">';
				print'<div class="heading">';
					print'<h2 class="card-title">'.$arrayRec['fnkUsername'].'</h2>';
				print'</div>';
				print'<div id="forumPhoto" class="valign-wrapper">';
					print'<img alt="room" class="responsive-img valign" src="'.$arrayRec['fldPhoto'].'">';
				print'</div>';
				print'<div class="description">';
					print'<p>'.$arrayRec['fldComment'].'</p>';
				print'</div>';
				print'<div class="card-action">';
					print'<a class="price"> $'.$arrayRec['fldPrice'].'</a>';
					print'<a class="location truncate">'.$arrayRec['fldLocation'].'</a>';
				print'</div>';
			print'</div>';
		print'</div>';
	print'</div>';
//print'</div>';
}

?>
<a href="?Page=servicePostForm" class="btn">Add Post</a>