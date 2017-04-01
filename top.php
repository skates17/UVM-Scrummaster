<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<?php
    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    // inlcude all libraries. 
    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    
    include(__DIR__ . "/lib/constants.php");

    print "<!-- require Database.php sdfea -->";

    require_once(__DIR__ . '/Database.php');

    // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
    //
    // Set up database connection
    //
    // generally you dont need the admin on the web

    print "<!-- make Database connections -->";
    $dbUserName = 'bb0f7db58de207';
    $whichPass = "r"; //flag for which one to use
    $dbName = 'ad_9e7e960f8cf9a6b';

    /*"credentials": {
                "jdbcUrl": "jdbc:mysql://us-cdbr-iron-east-03.cleardb.net/ad_9e7e960f8cf9a6b?user=bb0f7db58de207&password=9df46417",
                "uri": "mysql://bb0f7db58de207:9df46417@us-cdbr-iron-east-03.cleardb.net:3306/ad_9e7e960f8cf9a6b?reconnect=true",
                "name": "ad_9e7e960f8cf9a6b",
                "hostname": "us-cdbr-iron-east-03.cleardb.net",
                "port": "3306",
                "username": "bb0f7db58de207",
                "password": "9df46417"*/

    $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

    $dbUserName = 'bb0f7db58de207';
    $whichPass = "w";
    $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);

    print "<!-- Connected to database -->";
    //ldap
    function ldapName($uvmId) {
        if (empty($uvmId))
            return "no:netid";

        $name = "not:found";

        $ds = ldap_connect("ldap.uvm.edu");

        if ($ds) {
            $r = ldap_bind($ds);
            $dn = "uid=". $uvmId.",ou=People,dc=uvm,dc=edu";
            $filter = "(|(netid=".$uvmId."))";
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
    $name = explode(":", $name);
    $netIdArray = array($NetId, $name[0], $name[1]);
    $insertNames = "INSERT INTO `tblUser`(`pmkUsername`, `fldFirstName`, `fldLastName`) VALUES (?,?,?)";
    $addNames = $thisDatabaseWriter->insert($insertNames, $netIdArray, 0, 0, 0, 0, false, false);
    setcookie("netId", $NetId, time() + (60*60*24*1), '/');
?>

<title>PigPen</title>
        
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">
        
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/js/materialize.min.js"></script>
        <meta name="description" content="">
        <meta name="author" content="Jim Conallen">
        <link rel="icon" href="./images/bluemix_icon.png">
        
        <meta charset="utf-8">
        <meta name="author" content="Scrum Masters">
        <meta name="description" content="Dor Cleaner">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="clean.css" type="text/css" media="screen">
        
        

        <!-- Bootstrap core CSS -->
<!--     <link href="./css/bootstrap.min.css" rel="stylesheet"> -->

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="starter-template.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="./js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>