<?php

//##############################################################################
//
// main home page for the site 
// 
//##############################################################################
include "top.php";
if(isset($_POST['reject'])){
    $reviewId=(int) htmlentities($_POST['hidReviewId'],ENT_QUOTES, "UTF-8");
    $approved='0';
    $query3="UPDATE tblReviews SET fldApproved = ?";
    $query3.=" WHERE pmkReviewId=".$reviewId;
    $data2=array($approved);
    $results=$thisDatabaseWriter->insert($query3,$data2,1,0,0,0,FALSE,false);
}
// Begin output
$b='1';
$query= "SELECT pmkReviewId, fldStatus, fldRating, fldComments, fldNice, fldFunny, fldGoodDriver, fldGoodMusic, fldBadDriver, fldUncomfortable, fldMean, fldLate, fnkNetId, fnkRevieweesNetId, fldApproved";
$query.=" FROM tblReviews WHERE fldApproved=? ORDER BY fldRating DESC";
$data=array($b);
$info=$thisDatabaseReader->select($query, $data, 1,1,0,0, false, false);


?>
<div class="page">

<?php
    print'<h2 class="home">Reviews</h2>
    <a href="reviews.php" class="link">Submit a review</a>';

    foreach ($info as $arrayRec){
        print'<div id="review" class="review">';
        print'<div class="heading">';
        print'<h5 class="heading">'.$arrayRec['fnkRevieweesNetId'].'</h5><h6 class=status>';
        if($arrayRec['fldStatus']=='1'){
            print ' - Passenger';
        }
        else{
            print' - Driver';
        }
        print'</h6>';
        print'</div>';
        print'<div class = "reviewLeft">';
        print'<img id="ratingPic" alt="rating" src="images/'.$arrayRec['fldRating'].'Star.png"/>';
        print'<div class="divAttrib">';
        if($arrayRec['fldNice']=="1"){
            print'<p class="attributes">Nice</p>';
        }
        if($arrayRec['fldFunny']=="1"){
            print'<p class="attributes">Funny</p>';
        }
        if($arrayRec['fldGoodDriver']=="1"){
            print'<p class="attributes">Good Driver</p>';
        }
        if($arrayRec['fldGoodMusic']=="1"){
            print'<p class="attributes">Good Music</p>';
        }
        if($arrayRec['fldBadDriver']=="1"){
            print'<p class="attributes">Bad Driver</p>';
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
        if($arrayRec['fnkNetId']==$username OR $adminStatus==TRUE){
            print'<div class="approve">';
            print'<form action="'.$phpSelf.'" id="'.$arrayRec['pmkReviewId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
            print'<input type="hidden" id="hidReviewId'.$arrayRec['pmkReviewId'].'" name="hidReviewId" value="'.$arrayRec['pmkReviewId'].'">';
            print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="reject" type="submit" value="Delete" style="width:90px;">';
            print'</form>';
            print'</div>';
        }
        print'</div>';
        


}
?>
</div>




<?php
include "footer.php";
?>
