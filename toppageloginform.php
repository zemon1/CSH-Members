<!--DWLayoutTable-->
  <tr>
    <td width="100%" height="30" valign="top"><form name="form1" method="post" action="Motopages/login1.php">
        <table width="550" border="0" align="right">
          <!--DWLayoutTable-->
          <tr>
		  <?php
		  require_once 'connect.php';
		  	if(!isset($_SESSION['student_number']) && !isset($_SESSION['id'])){
			
            echo ('<td><div align="right"><a href="login.php">Log In</a> </div></td>');
            
			}
			else{
			$query = "SELECT first_name, last_name FROM users WHERE id = '$_SESSION[id]'";
			//$result = my_query($query);
			$result = my_query($query);
			
			if ($row = mysql_fetch_array($result)){			
			$first_name = $row['first_name'];
			$last_name = $row['last_name'];
			}else{
			echo "failed";
			}
			?>
			<td width="169" height="21">&nbsp;</td>
            <td width="371" align="right"><?php echo 'Hello ' . $first_name . ' ' . $last_name; ?>, <?php echo 'would you like to <a href="logout.php">Logout</a>?'; ?>
			<br /> <hr color="#FF0000" noshade></td>
            <?php
			}
			?>
          </tr>
        </table>
    </form></td>
  </tr>
