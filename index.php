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
require_once('./functions.php');
if (isset($_GET['l'])){
	$letter = $_GET['l'];
}
if (isset($_GET['up'])){
	$updated = $_GET['up'];
	if($updated == 't'){
		echo "<center><p>Thank you for updating the database!  Sorry it took so long, thats LDAP for you!</p></center>";
	}
}
?>
<center>
  
  <table width="950" border="1" cellspacing="0" cellpadding="0">
  <tr></tr>
  <tr>
    <td  bordercolor="#000000"><a href = "<?php echo $home_url . '/index.php?l=0'; ?>"><h1 id="Heading">CSH Members Profiles</h1></a></td>
    <td align="right" valign="top">
    <p>
	<form>
		<input type="text" size="30" onkeyup="showResult(this.value)" />
		<div id="livesearch"></div>
	</form>
    </p>
    </td>
  </tr>
  <tr>
    <td width="450">By Last Name:  <a href = "<?php echo $home_url . '/index.php?l=a'; ?>">A</a> <a href = "<?php echo $home_url . '/index.php?l=b'; ?>">B</a> <a href = "<?php echo $home_url . '/index.php?l=c'; ?>">C</a> <a href = "<?php echo $home_url . '/index.php?l=d'; ?>">D</a> <a href = "<?php echo $home_url . '/index.php?l=e'; ?>">E</a> <a href = "<?php echo $home_url . '/index.php?l=f'; ?>">F</a> <a href = "<?php echo $home_url . '/index.php?l=g'; ?>">G</a> <a href = "<?php echo $home_url . '/index.php?l=h'; ?>">H</a> <a href = "<?php echo $home_url . '/index.php?l=i'; ?>">I</a> <a href = "<?php echo $home_url . '/index.php?l=j'; ?>">J</a> <a href = "<?php echo $home_url . '/index.php?l=k'; ?>">K</a> <a href = "<?php echo $home_url . '/index.php?l=l'; ?>">L</a> <a href = "<?php echo $home_url . '/index.php?l=m'; ?>">M</a> <a href = "<?php echo $home_url . '/index.php?l=n'; ?>">N</a> <a href = "<?php echo $home_url . '/index.php?l=o'; ?>">O</a> <a href = "<?php echo $home_url . '/index.php?l=p'; ?>">P</a> <a href = "<?php echo $home_url . '/index.php?l=q'; ?>">Q</a> <a href = "<?php echo $home_url . '/index.php?l=r'; ?>">R</a> <a href = "<?php echo $home_url . '/index.php?l=s'; ?>">S</a> <a href = "<?php echo $home_url . '/index.php?l=t'; ?>">T</a> <a href = "<?php echo $home_url . '/index.php?l=u'; ?>">U</a> <a href = "<?php echo $home_url . '/index.php?l=v'; ?>">V</a> <a href = "<?php echo $home_url . '/index.php?l=w'; ?>">W</a> <a href = "<?php echo $home_url . '/index.php?l=x'; ?>">X</a> <a href = "<?php echo $home_url . '/index.php?l=y'; ?>">Y</a> <a href = "<?php echo $home_url . '/index.php?l=z'; ?>">Z</a></td>
    <td width="350" align="right">All Me Drink Admins RTPs E-Board Active Groups Years &nbsp; &nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    <?php
	if(isset($letter)){
		alphabetQueryHome($letter);
	}else{
		alphabetQueryHome('a');
	}
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><a href = "<?php echo $home_url . '/force.php'; ?>">Force Update</a> <a>Advanced Search</a> <a>Adiminstrate</a></td>
  </tr>
  </table>
  </center>
<?php
 
?>
</body>
</html>
