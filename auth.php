<?php
include "top.php";
//############################################################################
// find name in uvm directory      
function ldapName($uvmId) {
    if (empty($uvmId))
        return "no:netid";

    $name = "not:found";

    $ds = ldap_connect("ldap.uvm.edu");

    if ($ds) {
        $r = ldap_bind($ds);
        $dn = "uid=$uvmId,ou=People,dc=uvm,dc=edu";
        $filter = "(|(netid=$uvmId))";
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
$name = ldapName($NetId);
$name = split(":", $name);
print($name[1]);
$netIdArray = array($NetId, $name[0], $name[1]);
$insertNames = "INSERT INTO `tblUser`(`pmkUsername`, `fldFirstName`, `fldLastName`) VALUES (?,?,?)";
$addNames = $thisDatabaseWriter->insert($insertNames, $netIdArray, 0, 0, 0, 0, false, false);
setcookie("netId", $NetId, time() + (60*60*24*1), '/');
?>