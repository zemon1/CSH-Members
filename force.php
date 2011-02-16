<?php
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
require_once('database.php');

if(($ldapConn = ldap_connect(LDAP_HOST, LDAP_PORT)) == false){
	echo 'Error Connecting';
}

if(ldap_bind($ldapConn, LDAP_USER, LDAP_PASS) == false){
	echo 'Error Binding';
}
	
if (($search = ldap_search($ldapConn, LDAP_DN, 'uid=*')) == false){
	echo 'Error Searching';
}

if (($sorted = ldap_sort($ldapConn, $search, 'uid')) == false){
	echo 'Error Sorting Entires';
}

if (($entries = ldap_get_entries($ldapConn, $search)) == false){
	echo 'Error Getting Entires';
}


$entry = ldap_first_entry($ldapConn, $search);
$attrs = ldap_get_attributes($ldapConn, $entry);

//echo $attrs["count"] . "<br>";


$query = "SHOW COLUMNS FROM users";
$result = dbQuery($query);
$columnExists;

if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		$columnExists[] = $row['Field'];
	}
	//print_r($columnExists);
}
else{
//echo "UGH FRAK YOU". "<br>";	//table is completly empty?!?!?!? WTF
}
for ($i=0; $i < $attrs["count"]; $i++) {
	if (in_array($attrs[$i], $columnExists)) {
		//echo "Already Exists \"" . $attrs[$i] . "\" <br>";
	}
	else{
		$query = "ALTER TABLE users ADD $attrs[$i] VARCHAR(100)";
		dbQuery($query);
	}
}



foreach ($entries as $user){ // for ever user go through the loop
	
	if (!$user['uid'][0] == ""){ //If their User ID is nothing dont print their shit
		$query = "INSERT INTO " . MySQL_TABLE . " (`uid`)" . " VALUES ('". $user['uid'][0] ."')"; //Add their username to the mysql data base so you can refrence it later
		dbQuery($query); //function in database.php
		//echo $query1;
	}
	
	for ($i=0; $i < $attrs["count"]; $i++) { 
		$lowered = strtolower($attrs[$i]); // print the availible attributes
		
		if(isset($user[$lowered][0])){
			//echo $lowered . "<br />";
			
			if(!$user[$lowered][0] == ""){
				//echo $user[$lowered][0] . "<br />";
				$query = "UPDATE " . MySQL_TABLE . " SET `" . $attrs[$i] . "` = '" . $user[$lowered][0] . "' WHERE `uid` = '" . $user['uid'][0] . "'";
				dbQuery($query);
				//echo $query . "<br>";
				
			}else{			
				//echo "<br>";
			}
		}else{
			//echo $lowered . "<br />";
		}
	}

	//echo("<br><br>---------------------------------------------------------------------------<br><br>");
}
header( 'Location: ' . $home_url . '/index.php?l=a&up=t' );


?>