<?php include "inc/header.php"; 
	$db = new DB();
	$user = $db->getUserByID($_SESSION['accountID']);
?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>
	<form>
		<label>First Name</label>
		<input type="text" name="f_name" placeholder="<?php echo $_SESSION['accountFirstName'];?>">
		<label>Last Name</label>
		<input type="text" name="l_name" placeholder="<?php echo $_SESSION['accountFirstName'];?>">
		<label>Email</label>
		<input type="text" name="email" placeholder="<?php echo $_SESSION['accountFirstName'];?>">
		<label>Password</label>
		<input type="text" name="pass" placeholder="<?php echo $user['pass'];?>">

		<button>Update Info</button>
	</form>
	<label>Preference</label>
		<button>Update Preferences</button>
</body>
</html>