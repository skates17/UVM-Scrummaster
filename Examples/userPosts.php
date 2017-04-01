<?php
    include 'top.php';
    if($adminStatus==TRUE){
    if(isset($_POST['reject'])){
    $postId=(int) htmlentities($_POST['hidRiderId'], ENT_QUOTES, "UTF-8");
    $querySub="DELETE FROM tblRiderTrips WHERE fnkRiderId=".$postId;
    $res=$thisDatabaseWriter->delete($querySub,"",1,0,0,0,false,false);
    $query1="DELETE FROM tblRiders WHERE pmkRiderId =".$postId;
    $results=$thisDatabaseWriter->delete($query1,"",1,0,0,0,false,false);
}
// Begin output
if(isset($_POST['reject1'])){
    $postId1=(int) htmlentities($_POST['hidDriverId'], ENT_QUOTES, "UTF-8");
    $querySub="DELETE FROM tblDriverTrips WHERE fnkDriverId=".$postId1;
    $res=$thisDatabaseWriter->delete($querySub,"",1,0,0,0,false,false);
    $query3="DELETE FROM tblDrivers WHERE pmkDriverId =".$postId1;
    $results1=$thisDatabaseWriter->delete($query3,"",1,0,0,0,false,false);
}
if(isset($_POST['rejectDriver'])){
    $postId2=(int) htmlentities($_POST['hidDriverTripId'], ENT_QUOTES, "UTF-8");
    $query3="DELETE FROM tblDriverTrips WHERE pmkDriverTripId =".$postId2;
    $results1=$thisDatabaseWriter->delete($query3,"",1,0,0,0,false,false);
}
if(isset($_POST['rejectRider'])){
    $postId2=(int) htmlentities($_POST['hidTripId'], ENT_QUOTES, "UTF-8");
    $query3="DELETE FROM tblRiderTrips WHERE pmkRiderTripId =".$postId2;
    $results1=$thisDatabaseWriter->delete($query3,"",1,0,0,0,false,false);
}
    $query2="SELECT pmkDriverId, fldDepartureDate, fldDepartureTimeStart, fldDepartureTimeEnd, fldCity, fldState, fldComments, fnkNetId";
    $query2.=" FROM tblDrivers";
    $DriverInfo=$thisDatabaseReader->select($query2,"",0,0,0,0,false,false);
    
    $query="SELECT pmkRiderId, fldDepartureDate, fldDepartureTimeStart, fldDepartureTimeEnd, fldStreetAddress, fldCity, fldState, fldPickupLocation, fldComments, fnkNetId";
    $query.=" FROM tblRiders";
    $info=$thisDatabaseReader->select($query,"",0,0,0,0,false,false);
     print'<div class="page">';
    
        print '<h2 class="home1">Users Rider Submissions</h2>';
        foreach($info as $record){
            if($record['fnkNetId']!=$username){
                $timeStart= date('g:i a', strtotime($record['fldDepartureTimeStart']));
                $timeEnd= date('g:i a', strtotime($record['fldDepartureTimeEnd']));
                $date=  explode('-', $record['fldDepartureDate']);
                $month=$date[1];
                $day=$date[2];
                $year=$date[0];
                print'<div class=userTrip>';

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
                print'<p class="userRight">'.$record['fldStreetAddress'].'</p>';
                print'<p class="userRight">'.$record['fldCity'].'</p>';
                print'<p class="userRight">'.$record['fldState'].'</p>';
                print'</div>';

                print'<div class="userBottom">';
                print'<h6 class="userBottom">Comments';
                print ' - '.$record['fnkNetId'];
                print ' </h6>';
                if($record['fldComments']==""){
                    print '<p class="userBottom">None</p>';
                } 
                else{
                    print'<p class="userBottom">'.$record['fldComments'].'</p>';
                }
                print'</div>';

                print'<div class="approve">';
                print'<form action="'.$phpSelf.'" id="'.$record['pmkRiderId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
                print'<input type="hidden" id="hidRiderId'.$record['pmkRiderId'].'" name="hidRiderId" value="'.$record['pmkRiderId'].'">';
                print'<input class="button" id="'.$record['pmkRiderId'].'" name="reject" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
                print'</form>';
                print'</div>';

                print'</div>';
        }
    }
    print '<h2 class="home1">Users Driver Submissions</h2>';
        foreach($DriverInfo as $record1){
        if($record1['fnkNetId']==$username){
        
        $timeStart1= date('g:i a', strtotime($record1['fldDepartureTimeStart']));
        $timeEnd1= date('g:i a', strtotime($record1['fldDepartureTimeEnd']));
        $date1=  explode('-', $record1['fldDepartureDate']);
        $month1=$date1[1];
        $day1=$date1[2];
        $year1=$date1[0];
        print'<div class=userTrip>';
        
        print'<div class="userLeft">';
        print '<h6 class="userLeft">Departure Date</h6>';
        print '<p class="userLeft">'.$month1.'/'.$day1.'/'.$year1.'</p>';
        print '<h6 class="userLeft">Departure Time</h6>';
        print '<p class="userLeft">Between '.$timeStart1.'</p>';
        print '<p class="userLeft"> and '.$timeEnd1.'</p>';
        print'</div>';
        
        print'<div class="userRight">';
        print'<h6 class="userRight">Destination</h6>';
        print'<p class="userRight">'.$record1['fldCity'].'</p>';
        print'<p class="userRight">'.$record1['fldState'].'</p>';
        print'</div>';
        
        print'<div class="userBottom">';
        print'<h6 class="userBottom">Comments';
        
       
        print ' - '.$record1['fnkNetId'];
        
        print'</h6>';
        if($record1['fldComments']==""){
            print '<p class="userBottom">None</p>';
        }else{
            print'<p class="userBottom">'.$record1['fldComments'].'</p>';
        }
        print'</div>';
        
        print'<div class="approve">';
        print'<form action="'.$phpSelf.'" id="'.$record1['pmkDriverId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
        print'<input type="hidden" id="hidDriverId'.$record1['pmkDriverId'].'" name="hidDriverId" value="'.$record1['pmkDriverId'].'">';
        print'<input class="button" id="'.$record1['pmkDriverId'].'" name="reject1" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        print'</form>';
        print'</div>';
        
        print'</div>';
    }
    }
    print'</div>';
    }
    ?>