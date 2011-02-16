<?php
require_once('./database.php');

//get the q parameter from URL
$q=$_GET["q"];



//lookup all links from the xml file if length of q>0
if (strlen($q)>0)
{

function search($q){
	$query = "SELECT * FROM " . MySQL_TABLE . " WHERE * LIKE " . $q . "%";
	$results = dbQuery($query);
	$num = mysql_num_rows($results) or die("mysql error - " . mysql_error() . " in query: $query");
	$i = 0;
	$arrays = mysql_fetch_array($results) or die("mysql error - " . mysql_error() . " in query: $query");
	
	$g = 0;
	$j = 0;
	
	while($i <= $num-1){
		$lastName = mysql_result($results,$i,'sn');
		$firstName = mysql_result($results,$i,'givenName');
		$userName =  mysql_result($results,$i,'uid');
	}
	
}
?> 