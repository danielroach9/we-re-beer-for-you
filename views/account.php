<?php include "inc/header.php";?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>
<!-- 	<form>
		<label></label>
		<label>Last Name</label>
		<label>Email</label>
		<input type="text" name="email" placeholder="<?php echo $_SESSION['accountFirstName'];?>">
		<label>Password</label>
		<input type="text" name="pass">

		<button>Update Info</button>
	</form>
	<label>Preference</label>
		<button>Update Preferences</button>
 -->
<div class="section no-pad-bot">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form id="loginForm">
            <div class="card-content">
              <span class="card-title center-align"><h4>Account Info</h4></span>
              <div class="row">
                <div class="input-field col s12">
                  <label for="f_name">First Name</label>
				  <input type="text" name="f_name" placeholder="<?php echo $_SESSION['accountFirstName'];?>">
                </div>
                <div class="input-field col s12">
				<label for="l_name">Last Name</label>
				<input type="text" name="l_name" placeholder="<?php echo $_SESSION['accountLastName'];?>">
                </div>
				<div class="input-field col s12">
				<label for="email">Email</label>
				<input type="text" name="email" placeholder="<?php echo $_SESSION['accountEmail'];?>">
                </div>
				<div class="input-field col s12">
				<label for="pass">Password</label>
				<input type="password" name="pass">
                </div>
              </div>
            </form>
			<div class="row center-align">
                <button class="btn brown waves-effect waves-light">Update Info</button>
              </div>
			<div class="row card-action center-align">
			  	<h5> Preferences </h5>
                <button class="btn brown waves-effect waves-light">Update Preferences</button>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <?php include "inc/footer.php"; ?>
