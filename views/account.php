<?php include "inc/header.php"; ?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>
	<form>
		<label>First Name</label>
		<input type="text" name="f_name" placeholder="<?php echo $_SESSION['accountFirstName'];?>">
		<label>Last Name</label>
		<input type="text" name="l_name">
		<label>Email</label>
		<input type="text" name="email">
		<label>Password</label>
		<input type="password" name="pass">

		<button>Update Info</button>
	</form>
	<label>Preference</label>
		<button>Update Preferences</button>
</body>
</html>