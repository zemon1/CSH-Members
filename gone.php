<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
 $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link REL=StyleSheet HREF="<?php echo $home_url . '/styles.css';?>" TYPE="text/css">

<title>CSH Members Profile Pages</title>
</head>

<body>
<?php
require_once('./passwords.php');
require_once('./functions.php');
		
		if(($ldapConn = ldap_connect(LDAP_HOST, LDAP_PORT)) == false){
			echo 'Error Connecting';
		}
		if(ldap_bind($ldapConn, LDAP_USER, LDAP_PASS) == false){
			echo 'Error Binding';
		}
		
		if (($search = ldap_search($ldapConn, LDAP_DN, 'uid=*')) == false){
			echo 'Error Searching';
		}
		if (($sorted = ldap_sort($ldapConn, $search, 'sn')) == false){
			echo 'Error Sorting Entires';
		}
		if (($entries = ldap_get_entries($ldapConn, $search)) == false){
			echo 'Error Getting Entires';
		}
		
		//echo '<pre>';
		//print_r($entries);
		//echo '</pre>';
		ldap_close($ldapConn);

		
		//echo "DN: " . LDAP_DN . "\n";
		//echo "Username: " . LDAP_USER . "\n";
		//echo "DN: " . LDAP_PASS . "\n";
		//echo "Host: " . LDAP_HOST . "\n";
		//echo "Port: " . LDAP_PORT . "\n";
		
		
?>
<center>
  <table width="950" border="1" cellspacing="0" cellpadding="0">
  <tr></tr>
  <tr>
    <td  bordercolor="#000000"><a href = "<?php echo $home_url . '/index.php'; ?>"><h1 id="Heading">CSH Members Profiles</h1></a></td>
    <td align="right" valign="top">
    <p>
    <form method = "post" action = "<?php echo $home_url . '/search.php'; ?>">
    Search: <input name="search" type="text" id="search"/> <input type="submit" name="submit" id="submit" value="Submit" />
    </form>
    </p>
    </td>
  </tr>
  <tr>
    <td width="402">&nbsp; &nbsp;  <a>A</a> <a>B</a> <a>C</a> <a>D</a> <a>E</a> <a>F</a> <a>G</a> <a>H</a> <a>I</a> <a>J</a> <a>K</a> <a>L</a> <a>M</a> <a>N</a> <a>O</a> <a>P</a> <a>Q</a> <a>U</a> <a>R</a> <a>S</a> <a>T</a> <a>U</a> <a>V</a> <a>U</a> <a>X</a> <a>Y</a> <a>Z</a></td>
    <td width="398" align="right">All Me Drink Admins RTPs E-Board Active Groups Years &nbsp; &nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    <?php
	/*
	echo '<table>';
		for ($i = 0; $i <= $entries["count"]; $i++) {
			for ($j = 0; $j <= $entries[$i]["count"]; $j++){
        		if ($entries[$i] == uid or givenname or sn){
					echo '<tr><td>';
					echo $entries[$i][$j] . ": " . $entries[$i][$entries[$i][$j]][0] . "\n";
					echo '</td></tr>';
				}else{
					echo 'Not';
				}
			}
        }
	echo '</table>';
	*/
	/*
	echo '<table border="1" cellpadding="5" cellspacing = "15">';
	for ($i = 0; $i <= 5; $i++){ //$entries["count"]; $i++) {
		for ($j = 0; $j <= $entries[$i]["count"]; $j++){
			//echo '<tr>';
			//echo '<td>';
			//echo '</td>';
			//echo '</tr>';
			
			
			if ($entries[$i][$j] == 'sn'){
				echo 'Last Name: ';
				echo $entries[$i][$entries[$i][$j]][0];
			}elseif ($entries[$i][$j] == 'givenname'){
				echo 'First Name: ';
				echo $entries[$i][$entries[$i][$j]][0];
			}elseif ($entries[$i][$j] == 'uid'){

			}
			
		}
	}
	echo '</table>';
	*/
		$values = array();
		unset($entries['count']);
		foreach($entries as $user){
			if(preg_match('/\d/', $user['sn'][0])){ // if their last name has any number in it only print a space because its not a real user
				echo "";
			}elseif(preg_match('/\d/',$user['sn'][0]) == false){
				if (isset($user['uid'][0]) && isset($user['sn'][0]) && isset($user['givenname'][0])){
					$values[] = "<td>UID: " . $user['uid'][0]."<br> Name: ".$user['sn'][0].", ".$user['givenname'][0]."<br></td>";
				}
				else if (isset($user['sn'][0]) && isset($user['givenname'][0])){
					$values[] =  "Name: ".$user['sn'][0].", ".$user['givenname'][0]."<br>";	
				}
			}
		}
	
		echo "<center><table width = 100% border = 0><tr>";
		unset($entries['count']);
		$i = 0;
		$j = 0;
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}
		
		$endRecord = $page * 21;
		$startRecord = (($page - 1)*21)+1; //get the page you were on previously multiply it by 20 then add one.  So if you were on page 2 
										   //before and now your on 3 it makes it so you start at 41 and go to record 60
		$recordNum = 0;
		for ($recordNum = $startRecord; $recordNum<=$endRecord; $recordNum++){ //$entries as $user
			echo $values[$recordNum];
			if($i%2==1){
				if($i%3==2){
					echo "</tr><tr>";
				}
			}else{
					if($i%3==2){
						echo "</tr><tr bgcolor = '#E8E8E8'>";
					}
				}
			$i++;
			$j++;
			}
				//echo "<br><hr>";
		echo "
		</tr>
		<tr>
		<td colspan='3' align = 'right'>";
		
		echo "</td>
		</tr>
		</table></center>";
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><a>Reload</a> <a>Advanced Search</a> <a>Adiminstrate</a></td>
  </tr>
  </table>
  </center>
<?php
 
?>
</body>
</html>
