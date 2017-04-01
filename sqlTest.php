<?php
include "top.php";
//############################################################################
// find name in uvm directory      
function ldapName($uvmID) {
    if (empty($uvmID))
        return "no:netid";

    $name = "not:found";

    $ds = ldap_connect("ldap.uvm.edu");

    if ($ds) {
        $r = ldap_bind($ds);
        $dn = "uid=$uvmID,ou=People,dc=uvm,dc=edu";
        $filter = "(|(netid=$uvmID))";
        $findthese = array("sn", "givenname");

        // now do the search and get the results which are stored in $info
        $sr = ldap_search($ds, $dn, $filter, $findthese);
        
        // if we found a match (in this example we should actually always find just one
        if (ldap_count_entries($ds, $sr) > 0) {
            $info = ldap_get_entries($ds, $sr);
            $name = $info[0]["givenname"][0] . ":" . $info[0]["sn"][0];
        }
    }

    ldap_close($ds);

    return $name;
}
$NetId = htmlentities($_SERVER["REMOTE_USER"], ENT_QUOTES, "UTF-8");

setcookie("netId" ,$NetId,time()+(60*60*24*1),'/');

//$pmkUsername = $_COOKIE["netId"];

$query3 = "SELECT pmkPlanId, `fnkStudentNetId`,`fldStudentDegree`FROM tblPlans WHERE fnkStudentNetId ='". $NetId ."' ;";
    $thePlans = $thisDatabaseReader->select($query3, "", 1, 0, 2, 0, false, false);
    foreach ($thePlans as $aPlan) {
        $_SESSION['planId'] = $aPlan['pmkPlanId'];
    }
?>

<h3>Begin making a plan here: <a href="createPlan.php">Create Plan.</a> </h3>
<h3>By clicking on view plan you'll see your most recently viewed plan:<a href="viewPlan.php">View Plan.</a></h3>
<?php
include "footer.php";
?>
</body>
</html>