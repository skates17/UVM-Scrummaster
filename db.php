<!--
/**
* Copyright 2017 IBM Corp. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* https://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
-->

<?php

$vcap_services_str = getenv("VCAP_SERVICES");

if(!$vcap_services_str){ // local dev env
    
	// try to load local copy of vcap services environment variable.  This will 
	// set the services credentials to be the bluemix ones.  That is the database
	// will be the remote (shared) db running as a service with Bluemix.
    if( file_exists("vcap.json") ) {
    	$vcapfile = fopen("vcap.json", "r") or die("Unable to open file!");
    	$vcap_services_str = fread($vcapfile,filesize("vcap.json"));
    	fclose($vcapfile);
    } 
    
} 

if( $vcap_services_str ) {
	// either on bluemix, or local file
	$vcap_services = json_decode($vcap_services_str);
	if( isset($vcap_services->{'mysql-5.5'}) ){ //if "mysql" db service is bound to this application
		$db = $vcap_services->{'mysql-5.5'}[0]->credentials;
	} 
	else if( isset($vcap_services->{'cleardb'}) ){ //if cleardb mysql db service is bound to this application
		$db = $vcap_services->{'cleardb'}[0]->credentials;
	}
	else {
		echo "Error: No suitable MySQL database bound to the application. <br>";
		die();
	}
	$mysql_database = $db->name;
	$mysql_port=$db->port;
	$mysql_server_name =$db->hostname . ':' . $db->port;
	$mysql_username = $db->username;
	$mysql_password = $db->password;

} else {
	// no vcap found.  set local defaults
	$mysql_server_name = "127.0.0.1:3306";
	$mysql_username = "root";
	$mysql_password = "";
	$mysql_database = "test";
}

//echo "Debug: " . $mysql_server_name . " " .  $mysql_username . " " .  $mysql_password . "\n";
$mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    die();
}
?>
