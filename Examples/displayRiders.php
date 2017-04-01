<?php
include 'top.php';

    if(isset($_POST['reject'])){
        $postId=(int) htmlentities($_POST['hidRiderId'], ENT_QUOTES, "UTF-8");
        $query1="DELETE FROM tblRiders WHERE pmkRiderId =".$postId;
        $results=$thisDatabaseWriter->delete($query1,"",1,0,0,0,false,false);
    }
    if(isset($_POST['accept'])){
        $postId=(int) htmlentities($_POST['hidRiderId'], ENT_QUOTES, "UTF-8");
        $query="INSERT IGNORE INTO tblRiderTrips(fnkDriverNetId,fnkRiderId) VALUES(?,?)";
        $data=array($username,$postId);
        $results=$thisDatabaseWriter->insert($query,$data,0,0,0,0,FALSE,FALSE);
    }


    $query="SELECT tblRiders.pmkRiderId, tblRiders.fldDepartureDate, tblRiders.fldDepartureTimeStart, "
            . "tblRiders.fldDepartureTimeEnd, tblRiders.fldStreetAddress, tblRiders.fldCity, "
            . "tblRiders.fldState, tblRiders.fldPickupLocation, tblRiders.fldComments, tblRiders.fnkNetId, t1.avgRating"
        . " FROM tblRiders JOIN( "
        . "SELECT tblReviews.fnkRevieweesNetId as name, AVG(tblReviews.fldRating) AS avgRating "
        . "FROM tblReviews GROUP BY tblReviews.fnkRevieweesNetId)t1 ON t1.name=tblRiders.fnkNetId ORDER BY fldDepartureDate ASC";
    #$data=array(1);
    $info=$thisDatabaseReader->select($query,"",0,1,0,0,false,false);
    print'<div class="page">';
    print'<h2 class="home">Ride Requests</h2>
            <a href="giveARide.php" class="link">Submit to Give A Ride</a> ';  
    foreach($info as $record){
        $riderId=$record['pmkRiderId'];
        $query1="SELECT fnkDriverNetId,fnkRiderId FROM tblRiderTrips WHERE fnkDriverNetId=? and fnkRiderId=?";
        $data1=array($username,$riderId);
        $info1=$thisDatabaseReader->select($query1,$data1,1,1,0,0,false,false);
        
        $timeStart= date('g:i a', strtotime($record['fldDepartureTimeStart']));
        $timeEnd= date('g:i a', strtotime($record['fldDepartureTimeEnd']));
        $date=  explode('-', $record['fldDepartureDate']);
        $month=$date[1];
        $day=$date[2];
        $year=$date[0];
        $avgRating=$record['avgRating'];
        $avgRating=  number_format($avgRating,1);
        $avgRating=$avgRating+0;
        print'<div class=userTrip>';
        print'<div class="heading">';
        print'<h5 class="heading">'.$record['fnkNetId'].'</h5><h6 class=avgRating>';
            print 'Average Rating: '.$avgRating.' / 5';
            print'</h6>';
        print'</div>';
        print'<div class="userLeft">';
        print '<h6 class="userLeft">Departure Date</h6>';
        print '<p class="userLeft">'.$month.'/'.$day.'/'.$year.'</p>';
        print '<h6 class="userLeft">Departure Time</h6>';
        print '<p class="userLeft">Between '.$timeStart.'</p>';
        print '<p class="userLeft"> and '.$timeEnd.'</p>';
        print'</div>';
        
        print'<div class="userRight">';
        print'<h6 class="userRight">Pickup Location</h6>';
        print'<p class="userRight">'.$record['fldPickupLocation'].'</p>';
        print'<h6 class="userRight">Destination</h6>';
        print'<p class="userRight">'.$record['fldCity'].'</p>';
        print'<p class="userRight">'.$record['fldState'].'</p>';
        print'</div>';
        
        print'<div class="userBottom">';
        print'<h6 class="userBottom">Comments';
        
        print ' </h6>';
        if($record['fldComments']==""){
            print '<p class="userBottom">None</p>';
        }else{
             print'<p class="userBottom">'.$record['fldComments'].'</p>';
        }
        print'</div>';
        
        
        print'<div class="approve">';
        print'<form action="'.$phpSelf.'" id="'.$record['pmkRiderId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
        print'<input type="hidden" id="hidRiderId'.$record['pmkRiderId'].'" name="hidRiderId" value="'.$record['pmkRiderId'].'">';
        if($adminStatus==TRUE){
            print'<input class="button" id="'.$record['pmkRiderId'].'" name="reject" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        }if(empty($info1)){
        print'<input class="button" id="'.$record['pmkRiderId'].'" name="accept" type="submit" value="Give a Ride" style="width:auto; display:inline-block">';
        }
        if(isset($_POST['accept'])and $record['pmkRiderId']==$postId){
            print'<h4 class="message">A request has been sent</h4>';
        }
        print'</form>';
        print'</div>';
        
        print'</div>';
    }
    
    
    
    
    
    
    print'</div>';
    ?>