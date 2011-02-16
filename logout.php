<?php 
session_start();
session_destroy();

setcookie("id","");
setcookie("username","");
?>

<?php
require_once'connect.php';
?>
<html>
<head>
<title>Welcome to MotoFied!</title>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
require_once'toppageloginform.php';
?>
</table>

<table>
<center>
<table width="725" height="150" border="0">
  <center><?php require_once'header.php'; ?></center>
 </center>
   <tr>
    <td width="130"><?php require_once'sidenav.php'; ?></td>
    <td width="595">
	<?php echo 'You are now logged out';
echo '<br />';
echo '<a href = \'http://www.sciencetogoonline.com/MF/index.php\'>Home Page</a>';?></td>
  </tr>
</table>



  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
require_once'footer.php';
?>
</body>
</html>