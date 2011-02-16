<?php
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

//$link = mysql_connect(MySQL_HOST, MySQL_USER, MySQL_PASS);
//mysql_select_db(MySQL_TABLE, $link);
//dbQuery($query);

//unset($entries['count']);

foreach($entries as $user){
		echo $user['uid'][0] . "<br>";
		echo $user['sn'][0] . "<br>";
		echo $user['givenName'][0] . "<br>";
		echo $user['cellPhone'][0] . "<br>";
		echo $user['homeDirectory'][0] . "<br>";
		echo $user['active'][0] . "<br>";
		echo $user['birthday'][0] . "<br>";
		echo $user['homePhone'][0] . "<br>";
		/*
		echo $user[$attr[$i]][0] . "<br>";
		echo $user[$attr[$i]][0] . "<br>";
		echo $user[$attr[$i]][0] . "<br>";
		echo $user[$attr[$i]][0] . "<br>";
		echo $user[$attr[$i]][0] . "<br>";
		*/
	
	echo "<br><br><br>";

	
}


/*
foreach($entries as $user){
	//echo $user['uid'][0];
	
	foreach($user as $value){
		if(!preg_match('/^[a-zA-Z]$/', $value[0])){
			//echo $value[0] . "</br>";
		}
	}
	//echo "</br>";
	//echo "</br>";
	//echo "</br>";
	echo "</br>";
}
*/





?>