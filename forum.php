<?php 

$b="SELECT pmkPostId, fnkUsername, fldPhoto, fldPrice, fldComment,fldLocation,fldTitle";
$b.=" FROM tblForum";
$data=array($b);
$info=$thisDatabaseReader->select($b,$data,0,0,0,0, false,false);

foreach($info as $arrayRec){


//print'<div class="row">';
	print'<div class="col s12 m4">';
		print'<div class="forumPost card">';
			print'<div class="card-content">';
				print'<div class="row">';
				print'<div class="heading">';
					print'<a href="?Page=users&a='.$arrayRec['fnkUsername'].'"><h2 class="card-title">'.$arrayRec['fldTitle'].'</h2></a>';
					print'<h6>Posted by '.$arrayRec['fnkUsername'].'</h6>';
				print'</div>';
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
                                print '<form method ="POST" class="col offset-s11">';
                                print '<button class="btn-floating waves-effect waves-light btn-sml circle offset-s6" type="submit" name="action">';
                                print '<i class="material-icons right blue">textsms</i>';
                                print '</button>';
                                print '</form>';
			print'</div>';
		print'</div>';
	print'</div>';
//print'</div>';
        
} 
if (isset($_POST['action'])){
    
                        $to =  "5857394007@vtext.com";
                            $from = "PigPen";
                            $message = $userid." is interested in cleaning your room at 4pm today for $".$arrayRec['fldPrice'].'';
                            $headers = "From: $from\n";
                            $msg = $message.' '.$headers;
                            mail($to, '', $message, $headers);
                            print '<div class="container" <h1 style="position:absolute">'.$msg.'</h1></div>';
                            '<div class="container" <h1="" style="position: absolute; top: 20px; text-align: center;'.$msg.'</h1></div>';

            
}
?>
