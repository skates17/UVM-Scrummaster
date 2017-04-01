<?php

//##############################################################################
//
// main home page for the site 
// 
//##############################################################################
include "top.php";


$a=$_COOKIE["netId"];

$reviewQuery="SELECT pmkReviewId, fldStatus, fldRating, fldComments, fldNice, fldFunny, fldGoodCleaner, fldGoodMusic, fldBadCleaner, fldUncomfortable, fldMean, fldLate, fnkNetId, fnkRevieweesNetId, fldApproved";
$reviewQuery.=" FROM tblReviews WHERE fnkRevieweesId= ?" ;
$data=array($a);
$QueryInfo=$thisDatabaseReader->select($reviewQuery, $data,1,1,0,0,false,false);

?>
<div class="page">
<?php
if(!empty($QueryInfo)){
    print'<h2 class="home">Reviews of You!</h2>';
        
        foreach ($QueryInfo as $arrayRec){
            if($arrayRec['fldApproved']=='-1' AND $i==0){
                print'<h2 class="home">Pending Reviews</h2>';
            }
            if($arrayRec['fldApproved']=='0' AND $j==0){
                print'<h2 class="home">Declined Reviews</h2>';
                $j++;
            }
            print'<div id="review" class="review">';
            print'<div class="heading">';
            print'<h5 class="heading">'.$arrayRec['fnkRevieweesNetId'].'</h5><h6 class=status>';
            if($arrayRec['fldStatus']=='1'){
                print ' - Cleanee';
            }
            else{
                print' - Cleaner';
            }
            print'</h6>';
            print'</div>';
            print'<div class = "reviewLeft">';
            
            print'<img id="ratingPic" src="images/'.$arrayRec['fldRating'].'Star.png"/>';
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
            
            
            print'</div>';
        }
}?>

<hr>

</div>
<?php
include "footer.php";