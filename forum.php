

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
                                print '<form method ="POST" class="col s12">';
                                print '<button class="btn waves-effect waves-light btn-sml" type="submit" name="action">Text';
                                print '<i class="material-icons right">send</i>';
                               
        
               
                                print '</button>';
                                print '</form>';
			print'</div>';
		print'</div>';
	print'</div>';
//print'</div>';
        
} 
if (isset($_POST['action'])){
                        $to =  "5854902358@vtext.com";
                            $from = "PigPen";
                            $message = "Someone is interested in cleaning your room at 4pm today for $".$arrayRec['fldPrice'].'';
                            $headers = "From: $from\n";
                            mail($to, '', $message, $headers);
}
?>
                    
<a href="?Page=servicePostForm" class="btn">Add Post</a>
