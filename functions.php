
<?php
require_once('./database.php');


function alphabetQueryHome($letter){
	$query = "SELECT * FROM " . MySQL_TABLE . " WHERE sn LIKE '" . $letter . "%';";
	$results = dbQuery($query);
	$num = mysql_num_rows($results) or die("mysql error - " . mysql_error() . " in query: $query");
	$i = 0;
	$arrays = mysql_fetch_array($results) or die("mysql error - " . mysql_error() . " in query: $query");
	
	$g = 0;
	$j = 0;
	echo '<table width = 100%><tr>';
	while($i <= $num-1){
		 
		$lastName = mysql_result($results,$i,'sn');
		$firstName = mysql_result($results,$i,'givenName');
		$userName =  mysql_result($results,$i,'uid');
		
		echo "<td>Username: " . $userName . "\n";
		echo "Name: " . $lastName . ", " . $firstName . "\n </td>";
		
		if($g%2==1){
			if($g%3==2){
				echo "</tr><tr>";
			}
		}else{
			if($i%3==2){
				echo "</tr><tr bgcolor = '#E8E8E8'>";
			}
		}
		$g++;
		$j++;
		
	
	
	
	$i++;
	}
	echo '</table>';
}
?>