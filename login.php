<?php
	require_once'startsession.php';
	require_once'connect.php';
    $error_msg = "";
	(mysql_select_db('Motofied'));
  // If the user isn't logged in, try to log them in
  if(!isset($_SESSION['id'])){
    if(isset($_POST['submit'])){
      // Connect to the database
     	$user1 = trim($_POST['username']);
		$pass1 = trim($_POST['password']);
      // Grab the user-entered log-in data
      $user_username = mysql_real_escape_string($user1);
      $user_password = mysql_real_escape_string($pass1);
	  
      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT id, username FROM users WHERE username = '$user_username' AND password = SHA('$user_password')";
        $data = my_query($query, $dbc);

        if (mysql_num_rows($data) == 1){
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysql_fetch_array($data);
          $_SESSION['id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
		  
          setcookie('id', $row['id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
		  
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/welcome.php'. '?un=' . $_SESSION['id'];
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
  echo mysql_error();
 
 require_once'header.php';
?>


<?php
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['id'])) {
    echo '<p>' . $error_msg . '</p>';
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Log In</legend>
      <label for="username">Username:</label>
      <input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br />
      <label for="password">Password:</label>
      <input type="password" name="password" />
    </fieldset>
    <input type="submit" value="Log In" name="submit" />
  </form>

<?php
  }
  else {
    // Confirm the successful log-in
	$first_name = $row['first_name'];
	$last_name = $row['last_name'];
    echo('<p>You are logged in as ' . $first_name . ' ' . $last_name . '.</p>');
  }

	require_once 'footer.php';
?>
