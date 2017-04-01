<?php
$a=$_GET["a"];
//$a="jpornelo";

$specificQuery="SELECT fldRating, fldComments, fldNice, fldFunny, fldGoodCleaner, fldGoodMusic, fldBadCleaner, fldUncomfortable, fldMean, fldLate, fnkRevieweesNetId, fnkNetId";
$specificQuery.=" FROM tblReviews" ;

$QueryInfo=$thisDatabaseReader->select($specificQuery, $a,0,0,0,0,false,false);
?>
<div class="page">
<?php
if(!empty($QueryInfo)){
    print'<h2 class="home">Reviews of You!</h2>';
        
        foreach ($QueryInfo as $arrayRec){
            print'<div class="heading">';
            print'<h5 class="heading">'.$arrayRec['fnkRevieweesNetId'].'</h5><h6 class=status>';
            print'</h6>';
            print'</div>';
            print'<div class = "reviewLeft">';
            
            //print'<img id="ratingPic" src="images/'.$arrayRec['fldRating'].'Star.png"/>';
            print'<div class="divAttrib">';
            if($arrayRec['fldNice']=="1"){
                print'<p class="attributes">Nice</p>';
            }
            if($arrayRec['fldFunny']=="1"){
                print'<p class="attributes">Funny</p>';
            }
            if($arrayRec['fldGoodCleaner']=="1"){
                print'<p class="attributes">Good Cleaner</p>';
            }
            if($arrayRec['fldGoodMusic']=="1"){
                print'<p class="attributes">Good Music</p>';
            }
            if($arrayRec['fldBadCleaner']=="1"){
                print'<p class="attributes">Bad Cleaner</p>';
            }
            if($arrayRec['fldUncomfortable']=="1"){
                print'<p class="attributes">Uncomfortable</p>';
            }
            if($arrayRec['fldMean']=="1"){
                print'<p class="attributes">Mean</p>';
            }
            if($arrayRec['fldLate']=="1"){
                print'<p class="attributes">Late</p>';
            }
            print'</div>';
            print'</div>';
            print'<div class = "reviewRight">';
            print'<h4 class="commentsRev">Comments</h4>';
            print'<p class = "commentReview">'.$arrayRec['fldComments'].'</p>';
            print'</div>';
            print'<div class="reviewBottom">';
            print'<h4 class="reviewBot">-'.$arrayRec['fnkNetId'].'</h4>';
            print'</div>';
            //print'<div class="approve">';
//            print'<form action="'.$phpSelf.'" id="'.$arrayRec['pmkReviewId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
//            print'<input type="hidden" id="hidReviewId'.$arrayRec['pmkReviewId'].'" name="hidReviewId" value="'.$arrayRec['pmkReviewId'].'">';
//            if($arrayRec['fldApproved']=='-1'){
//                print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="approve" type="submit" value="Approve" style="width:90px; margin-right: 5px;">';
//            }if($arrayRec['fldApproved']=='0'){
//                print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="reject1" type="submit" value="Delete" style="width:90px;">';
//            }
//            else{
//                print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="reject" type="submit" value="Reject" style="width:90px;">';
//            }
//            print'</form>';
            //print'</div>';
            
            
            //print'</div>';
        }
}?>
    <hr>
