<?php

//##############################################################################
//
// main home page for the site 
// 
//##############################################################################
include "top.php";
if(isset($_POST['approve']) OR isset($_POST['reject'])){
    if(isset($_POST['reject'])){
        $reviewId=(int) htmlentities($_POST['hidReviewId'],ENT_QUOTES, "UTF-8");
        $approved='0';
    }
    else{
        $reviewId=(int) htmlentities($_POST['hidReviewId'],ENT_QUOTES, "UTF-8");
        $approved='1';
    }
    $query3="UPDATE tblReviews SET fldApproved = ?";
    $query3.=" WHERE pmkReviewId=".$reviewId;
    $data2=array($approved);
    $results=$thisDatabaseWriter->insert($query3,$data2,1,0,0,0,FALSE,false);
}
if(isset($_POST['reject1'])){
    $reviewId=(int) htmlentities($_POST['hidReviewId'], ENT_QUOTES, "UTF-8");
        $query3="DELETE FROM tblReviews WHERE pmkReviewId =".$reviewId;
        $results1=$thisDatabaseWriter->delete($query3,"",1,0,0,0,false,false);
}
// Begin output
$a='-1';
$c='0';
$query= "SELECT pmkReviewId, fldStatus, fldRating, fldComments, fldNice, fldFunny, fldGoodDriver, fldGoodMusic, fldBadDriver, fldUncomfortable, fldMean, fldLate, fnkNetId, fnkRevieweesNetId, fldApproved";
$query.=" FROM tblReviews WHERE fldApproved = ? OR fldApproved = ? ORDER BY fldApproved ASC";
$data=array($a,$c);
$info=$thisDatabaseReader->select($query, $data, 1,2,0,0, false, false);


?>
<div class="page">

<?php
$i=0;
$j=0;
    
foreach ($info as $arrayRec){
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
                print ' - Passenger';
            }
            else{
                print' - Driver';
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
            print'<div class="approve">';
            print'<form action="'.$phpSelf.'" id="'.$arrayRec['pmkReviewId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
            print'<input type="hidden" id="hidReviewId'.$arrayRec['pmkReviewId'].'" name="hidReviewId" value="'.$arrayRec['pmkReviewId'].'">';
            if($arrayRec['fldApproved']=='-1'){
                print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="approve" type="submit" value="Approve" style="width:90px; margin-right: 5px;">';
            }if($arrayRec['fldApproved']=='0'){
                print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="reject1" type="submit" value="Delete" style="width:90px;">';
            }
            else{
                print'<input class="button" id="'.$arrayRec['pmkReviewId'].'" name="reject" type="submit" value="Reject" style="width:90px;">';
            }
            print'</form>';
            print'</div>';
            
            
            print'</div>';
        }

?>
</div>




<?php
include "footer.php";
?>
