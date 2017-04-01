<?php

//##############################################################################
//
// main home page for the site 
// 
//##############################################################################
include "top.php";

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
if(isset($_POST['acceptDriver'])){
    $approved='1';
    $postId2=(int) htmlentities($_POST['hidDriverTripId'], ENT_QUOTES, "UTF-8");
    $query3="UPDATE tblDriverTrips SET fldApproved=? WHERE pmkDriverTripId =".$postId2;
    $data=array($approved);
    $results1=$thisDatabaseWriter->delete($query3,$data,1,0,0,0,false,false);
}
if(isset($_POST['rejectRider'])){
    $postId2=(int) htmlentities($_POST['hidTripId'], ENT_QUOTES, "UTF-8");
    $query3="DELETE FROM tblRiderTrips WHERE pmkTripId =".$postId2;
    $results1=$thisDatabaseWriter->delete($query3,"",1,0,0,0,false,false);
}
if(isset($_POST['acceptRider'])){
    $approved='1';
    $postId2=(int) htmlentities($_POST['hidTripId'], ENT_QUOTES, "UTF-8");
    $query3="UPDATE tblRiderTrips SET fldApproved=? WHERE pmkTripId =".$postId2;
    $data=array($approved);
    $results1=$thisDatabaseWriter->delete($query3,$data,1,0,0,0,false,false);
}

$query="SELECT pmkRiderId, fldDepartureDate, fldDepartureTimeStart, fldDepartureTimeEnd, fldStreetAddress, fldCity, fldState, fldPickupLocation, fldComments, fnkNetId";
$query.=" FROM tblRiders WHERE fnkNetId=?";
$data=array($username);
$info=$thisDatabaseReader->select($query,$data,1,0,0,0,false,false);


$query2="SELECT pmkDriverId, fldDepartureDate, fldDepartureTimeStart, fldDepartureTimeEnd, fldCity, fldState, fldComments, fnkNetId";
$query2.=" FROM tblDrivers WHERE fnkNetId=?";
$data1=array($username);
$DriverInfo=$thisDatabaseReader->select($query2,$data1,1,0,0,0,false,false);

    $a='1';
    $queryPendingDriver="SELECT pmkDriverTripId,fnkDriverId,fldApproved, "
            . "tblDrivers.fnkNetId FROM tblDriverTrips, tblDrivers "
            . "WHERE fnkDriverId=tblDrivers.pmkDriverId AND tblDrivers.fnkNetId=? AND fldApproved=?";
    $data6=array($username,$a);
    $driverTrip=$thisDatabaseReader->select($queryPendingDriver,$data6,1,2,0,0,false,false);
    
    $b='-1';
    $queryPendingDriver1="SELECT pmkDriverTripId,fnkDriverId,fldApproved, "
            . "tblDrivers.fnkNetId FROM tblDriverTrips, tblDrivers "
            . "WHERE fnkDriverId=tblDrivers.pmkDriverId AND tblDrivers.fnkNetId=? AND fldApproved=?";
    $data7=array($username,$b);
    $driverTripB=$thisDatabaseReader->select($queryPendingDriver1,$data7,1,2,0,0,false,false);
    
    

    $queryConfirmedRider="SELECT pmkTripId,fnkDriverNetId,fnkRiderId,fldApproved, "
            . "tblRiders.fnkNetId FROM tblRiderTrips,tblRiders "
            . "WHERE fnkRiderId=tblRiders.pmkRiderId AND tblRiders.fnkNetId=? AND fldApproved=?";
    $riderTrip=$thisDatabaseReader->select($queryConfirmedRider,$data6,1,2,0,0,false,false);

    $queryPendingRider="SELECT pmkTripId,fnkDriverNetId,fnkRiderId,fldApproved, "
            . "tblRiders.fnkNetId FROM tblRiderTrips,tblRiders "
            . "WHERE fnkRiderId=tblRiders.pmkRiderId AND tblRiders.fnkNetId=? AND fldApproved=?";
    $riderTripB=$thisDatabaseReader->select($queryPendingRider,$data7,1,2,0,0,false,false);

    
    $bigQuery="SELECT pmkDriverTripId, fnkRiderNetId, fnkDriverId,tblDriverTrips.fldApproved, tblDrivers.pmkDriverId, 
        tblDrivers.fldDepartureDate, tblDrivers.fldDepartureTimeStart, tblDrivers.fldCity, tblDrivers.fldState, tblDrivers.fldComments, 
        tblDrivers.fnkNetId, tblUsers.fldFirstName, tblUsers.fldLastName, tblUsers.fldEmail, tblUsers.fldPhone 
        FROM tblDriverTrips, tblDrivers, tblUsers WHERE fnkDriverId=tblDrivers.pmkDriverId AND tblDrivers.fnkNetId=tblUsers.pmkNetId AND
        tblDrivers.fnkNetId=? AND tblDriverTrips.fldApproved=?";
    $bigData= array($username,$a);
    $bigInfo=$thisDatabaseReader->select($bigQuery,$bigData,1,2,0,0,false,false);
    
    $bigQuery1="SELECT pmkDriverTripId, fnkRiderNetId, fnkDriverId,tblDriverTrips.fldApproved, tblDrivers.pmkDriverId, 
        tblDrivers.fldDepartureDate, tblDrivers.fldDepartureTimeStart, tblDrivers.fldCity, tblDrivers.fldState, tblDrivers.fldComments, 
        tblDrivers.fnkNetId, tblUsers.fldFirstName, tblUsers.fldLastName, tblUsers.fldEmail, tblUsers.fldPhone 
        FROM tblDriverTrips, tblDrivers, tblUsers WHERE fnkDriverId=tblDrivers.pmkDriverId AND tblDrivers.fnkNetId=tblUsers.pmkNetId AND
        tblDrivers.fnkNetId=? AND tblDriverTrips.fldApproved=?";
    $bigData1= array($username,$b);
    $bigInfo1=$thisDatabaseReader->select($bigQuery1,$bigData1,1,2,0,0,false,false);
    
    
    $bigQuery2="SELECT pmkTripId, fnkDriverNetId, fnkRiderId,tblRiderTrips.fldApproved, tblRiders.pmkRiderId, 
        tblRiders.fldDepartureDate, tblRiders.fldDepartureTimeStart, tblRiders.fldStreetAddress, tblRiders.fldCity, tblRiders.fldState, tblRiders.fldPickupLocation, tblRiders.fldComments, 
        tblRiders.fnkNetId, tblUsers.fldFirstName, tblUsers.fldLastName, tblUsers.fldEmail, tblUsers.fldPhone 
        FROM tblRiderTrips, tblRiders, tblUsers WHERE fnkRiderId=tblRiders.pmkRiderId AND tblRiders.fnkNetId=tblUsers.pmkNetId AND
        tblRiders.fnkNetId=? AND tblRiderTrips.fldApproved=?";
    $bigData2= array($username,$a);
    $bigInfo2=$thisDatabaseReader->select($bigQuery2,$bigData2,1,2,0,0,false,false);
    
    $bigQuery3="SELECT pmkTripId, fnkDriverNetId, fnkRiderId,tblRiderTrips.fldApproved, tblRiders.pmkRiderId, 
        tblRiders.fldDepartureDate, tblRiders.fldDepartureTimeStart, tblRiders.fldStreetAddress, tblRiders.fldCity, tblRiders.fldState, tblRiders.fldPickupLocation, tblRiders.fldComments, 
        tblRiders.fnkNetId, tblUsers.fldFirstName, tblUsers.fldLastName, tblUsers.fldEmail, tblUsers.fldPhone 
        FROM tblRiderTrips, tblRiders, tblUsers WHERE fnkRiderId=tblRiders.pmkRiderId AND tblRiders.fnkNetId=tblUsers.pmkNetId AND
        tblRiders.fnkNetId=? AND tblRiderTrips.fldApproved=?";
    $bigData3= array($username,$b);
    $bigInfo3=$thisDatabaseReader->select($bigQuery3,$bigData3,1,2,0,0,false,false);
?>
<div class="page">
<?php
if(!empty($bigInfo)){
    print'<h2 class="home">Your Confirmed Trips!</h2>';
        
        foreach($bigInfo as $bigRecord){
        $timeStart= date('g:i a', strtotime($bigRecord['fldDepartureTimeStart']));
        $date=  explode('-', $bigRecord['fldDepartureDate']);
        $month=$date[1];
        $day=$date[2];
        $year=$date[0];
        $insideQuery='SELECT pmkNetId, fldFirstName, fldLastName, fldEmail, fldPhone FROM tblUsers WHERE pmkNetId=?';
        $littleDat=$bigRecord['fnkRiderNetId'];
        $insideData=array($littleDat);
        $insideInfo=$thisDatabaseReader->select($insideQuery,$insideData,1,0,0,0,false,false);
        
        print'<div class=userTrip>';
        print'<div class="userTop1">';
        print '<h6 class="confirmed">Status: Confirmed</h6>';
        print'</div>';
        print'<div class="userLeft1">';
        
        print '<h6 class="userLeft1">Driver</h6>';
        print '<p class="userLeft1">'.$bigRecord['fldFirstName'].' '.$bigRecord['fldLastName'].'</p>';
        print '<p class="userLeft1">'.$bigRecord['fldPhone'].'</p>';
        print '<p class="userLeft1">'.$bigRecord['fldEmail'].'</p>';
        print'</div>';
        
        
        print'<div class="userRight1">';
        print'<h6 class="userRight1">Passenger</h6>';
        print'<p class="userRight1">'.$insideInfo[0]['fldFirstName'].' '.$insideInfo[0]['fldLastName'];
        print'<p class="userRight1">'.$insideInfo[0]['fldPhone'].'</p>';
        print'<p class="userRight1">'.$insideInfo[0]['fldEmail'].'</p>';
        print'</div>';
        
        print'<div class="userBottom">';
        print'<h6 class="userBottom1">Departure Info</h6>';
        print'<p class="userBottom1">Departure Date - '.$month.'/'.$day.'/'.$year.'</p>';
        print'<p class="userBottom1">Departure Time - '.$timeStart.'</p>';
        print'<p class="userBottom1">City - '.$bigRecord['fldCity'].'</p>';
        print'<p class="userBottom1">State - '.$bigRecord['fldState'].'</p>';
        print'</div>';
  
        
        print'<div class="approve">';
        print'<form action="'.$phpSelf.'" id="'.$bigRecord['pmkDriverTripId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
        print'<input type="hidden" id="hidDriverTripId'.$bigRecord['pmkDriverTripId'].'" name="hidDriverTripId" value="'.$bigRecord['pmkDriverTripId'].'">';
        print'<input class="button" id="'.$bigRecord['pmkDriverTripId'].'" name="rejectDriver" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        print'</form>';
        print'</div>';
        
        print'</div>';
        }
    }
    
    if(!empty($bigInfo1)){
    print'<h2 class="home">Your Pending Trips!</h2>';
        
        foreach($bigInfo1 as $bigRecord1){
        $timeStart= date('g:i a', strtotime($bigRecord1['fldDepartureTimeStart']));
        $date=  explode('-', $bigRecord1['fldDepartureDate']);
        $month=$date[1];
        $day=$date[2];
        $year=$date[0];
        $insideQuery='SELECT pmkNetId, fldFirstName, fldLastName, fldEmail, fldPhone FROM tblUsers WHERE pmkNetId=?';
        $littleDat1=$bigRecord1['fnkRiderNetId'];
        $insideData=array($littleDat1);
        $insideInfo1=$thisDatabaseReader->select($insideQuery,$insideData,1,0,0,0,false,false);
        
        print'<div class=userTrip>';
        print'<div class="userTop1">';
        print '<h6 class="pending">Status: Pending</h6>';
        print'</div>';
        print'<div class="userLeft1">';
        
        print '<h6 class="userLeft1">Driver</h6>';
        print '<p class="userLeft1">'.$bigRecord1['fldFirstName'].' '.$bigRecord1['fldLastName'].'</p>';
        print '<p class="userLeft1">'.$bigRecord1['fldPhone'].'</p>';
        print '<p class="userLeft1">'.$bigRecord1['fldEmail'].'</p>';
        print'</div>';
        
        
        print'<div class="userRight1">';
        print'<h6 class="userRight1">Passenger</h6>';
        print'<p class="userRight1">'.$insideInfo1[0]['fldFirstName'].' '.$insideInfo1[0]['fldLastName'];
        print'<p class="userRight1">'.$insideInfo1[0]['fldPhone'].'</p>';
        print'<p class="userRight1">'.$insideInfo1[0]['fldEmail'].'</p>';
        print'</div>';
        
        print'<div class="userBottom">';
        print'<h6 class="userBottom1">Departure Info</h6>';
        print'<p class="userBottom1">Departure Date - '.$month.'/'.$day.'/'.$year.'</p>';
        print'<p class="userBottom1">Departure Time - '.$timeStart.'</p>';
        print'<p class="userBottom1">City - '.$bigRecord1['fldCity'].'</p>';
        print'<p class="userBottom1">State - '.$bigRecord1['fldState'].'</p>';
        print'</div>';

        print'<div class="approve">';
        print'<form action="'.$phpSelf.'" id="'.$bigRecord1['pmkDriverTripId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
        print'<input type="hidden" id="hidDriverTripId'.$bigRecord1['pmkDriverTripId'].'" name="hidDriverTripId" value="'.$bigRecord1['pmkDriverTripId'].'">';
        print'<input class="button" id="'.$bigRecord1['pmkDriverTripId'].'" name="rejectDriver" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        print'<input class="button" id="'.$bigRecord1['pmkDriverTripId'].'" name="acceptDriver" type="submit" value="Accept Request" style="width:inherit; margin-right: 5px;">';
        print'</form>';
        print'</div>';
        
        print'</div>';
        }
    }
    
    

if(!empty($bigInfo2)){
    print'<h2 class="home">Your Confirmed Passengers!</h2>';
        
        foreach($bigInfo2 as $bigRecord2){
        $timeStart= date('g:i a', strtotime($bigRecord2['fldDepartureTimeStart']));
        $date=  explode('-', $bigRecord2['fldDepartureDate']);
        $month=$date[1];
        $day=$date[2];
        $year=$date[0];
        $insideQuery2='SELECT pmkNetId, fldFirstName, fldLastName, fldEmail, fldPhone FROM tblUsers WHERE pmkNetId=?';
        $littleDat=$bigRecord2['fnkDriverNetId'];
        $insideData2=array($littleDat);
        $insideInfo2=$thisDatabaseReader->select($insideQuery2,$insideData2,1,0,0,0,false,false);
        
        print'<div class=userTrip>';
        print'<div class="userTop1">';
        print '<h6 class="confirmed">Status: Confirmed</h6>';
        print'</div>';
        print'<div class="userLeft1">';
        
        print '<h6 class="userLeft1">Passenger</h6>';
        print '<p class="userLeft1">'.$bigRecord2['fldFirstName'].' '.$bigRecord2['fldLastName'].'</p>';
        print '<p class="userLeft1">'.$bigRecord2['fldPhone'].'</p>';
        print '<p class="userLeft1">'.$bigRecord2['fldEmail'].'</p>';
        print'</div>';
        
        
        print'<div class="userRight1">';
        print'<h6 class="userRight1">Driver</h6>';
        print'<p class="userRight1">'.$insideInfo2[0]['fldFirstName'].' '.$insideInfo2[0]['fldLastName'];
        print'<p class="userRight1">'.$insideInfo2[0]['fldPhone'].'</p>';
        print'<p class="userRight1">'.$insideInfo2[0]['fldEmail'].'</p>';
        print'</div>';
        
        print'<div class="userBottom">';
        print'<h6 class="userBottom1">Departure Info</h6>';
        print'<p class="userBottom1">Departure Date - '.$month.'/'.$day.'/'.$year.'</p>';
        print'<p class="userBottom1">Departure Time - '.$timeStart.'</p>';
        print'<p class="userBottom1">Pickup Location - '.$bigRecord2['fldPickupLocation'].'</p>';
        print'<p class="userBottom1">Street - '.$bigRecord2['fldStreetAddress'].'</p>';
        print'<p class="userBottom1">City - '.$bigRecord2['fldCity'].'</p>';
        print'<p class="userBottom1">State - '.$bigRecord2['fldState'].'</p>';
        print'</div>';
  
        
        print'<div class="approve">';
        print'<form action="'.$phpSelf.'" id="'.$bigRecord2['pmkTripId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
        print'<input type="hidden" id="hidTripId'.$bigRecord2['pmkTripId'].'" name="hidTripId" value="'.$bigRecord2['pmkTripId'].'">';
        print'<input class="button" id="'.$bigRecord2['pmkTripId'].'" name="rejectRider" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        print'</form>';
        print'</div>';
        
        print'</div>';
        }
    }
    
    
    
    if(!empty($bigInfo3)){
    print'<h2 class="home">Your Pending Passengers!</h2>';
        
        foreach($bigInfo3 as $bigRecord3){
        $timeStart= date('g:i a', strtotime($bigRecord3['fldDepartureTimeStart']));
        $date=  explode('-', $bigRecord3['fldDepartureDate']);
        $month=$date[1];
        $day=$date[2];
        $year=$date[0];
        $insideQuery3='SELECT pmkNetId, fldFirstName, fldLastName, fldEmail, fldPhone FROM tblUsers WHERE pmkNetId=?';
        $littleDat=$bigRecord3['fnkDriverNetId'];
        $insideData3=array($littleDat);
        $insideInfo3=$thisDatabaseReader->select($insideQuery3,$insideData3,1,0,0,0,false,false);
        
        print'<div class=userTrip>';
        print'<div class="userTop1">';
        print '<h6 class="pending">Status: Pending</h6>';
        print'</div>';
        print'<div class="userLeft1">';
        
        print '<h6 class="userLeft1">Passenger</h6>';
        print '<p class="userLeft1">'.$bigRecord3['fldFirstName'].' '.$bigRecord3['fldLastName'].'</p>';
        #print '<p class="userLeft1">'.$bigRecord3['fldPhone'].'</p>';
        print '<p class="userLeft1">'.$bigRecord3['fldEmail'].'</p>';
        print'</div>';
        
        
        print'<div class="userRight1">';
        print'<h6 class="userRight1">Driver</h6>';
        print'<p class="userRight1">'.$insideInfo3[0]['fldFirstName'].' '.$insideInfo3[0]['fldLastName'];
        #print'<p class="userRight1">'.$insideInfo3[0]['fldPhone'].'</p>';
        print'<p class="userRight1">'.$insideInfo3[0]['fldEmail'].'</p>';
        print'</div>';
        
        print'<div class="userBottom">';
        print'<h6 class="userBottom1">Departure Info</h6>';
        print'<p class="userBottom1">Departure Date - '.$month.'/'.$day.'/'.$year.'</p>';
        print'<p class="userBottom1">Departure Time - '.$timeStart.'</p>';
        print'<p class="userBottom1">Pickup Location - '.$bigRecord3['fldPickupLocation'].'</p>';
        #print'<p class="userBottom1">Street - '.$bigRecord3['fldStreetAddress'].'</p>';
        print'<p class="userBottom1">City - '.$bigRecord3['fldCity'].'</p>';
        print'<p class="userBottom1">State - '.$bigRecord3['fldState'].'</p>';
        print'</div>';
  
        
        print'<div class="approve">';
        print'<form action="'.$phpSelf.'" id="'.$bigRecord3['pmkTripId'].'" method="post" style="padding:0; border: none; background-color: #eaeaea;">';
        print'<input type="hidden" id="hidTripId'.$bigRecord3['pmkTripId'].'" name="hidTripId" value="'.$bigRecord3['pmkTripId'].'">';
        print'<input class="button" id="'.$bigRecord3['pmkTripId'].'" name="rejectRider" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        print'<input class="button" id="'.$bigRecord3['pmkTripId'].'" name="acceptRider" type="submit" value="Accept Request" style="width:inherit; margin-right: 5px;">';
        print'</form>';
        print'</div>';
        
        print'</div>';
        }
    }


    if(!empty($info)){
        print'<h2 class="home">Your Submitted GetaRides!</h2>';
        
    foreach($info as $record){
        if($record['fnkNetId']==$username){
        
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
        print'<input class="button" id="'.$record['pmkRiderId'].'" name="reject" type="submit" value="Delete" style="width:90px; margin-right: 5px;">';
        print'</form>';
        print'</div>';
        
        print'</div>';
    }
    }
    print'<hr>';
    }

    if(!empty($DriverInfo)){
        print'<h2 class="home1">Your Submitted GiveaRides!</h2>';
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
        print ' </h6>';
        if($record1['fldComments']==""){
            print '<p class="userBottom">None</p>';
        }
        else{
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
    }
?>

<hr>

</div>
<?php
include "footer.php";
?>
