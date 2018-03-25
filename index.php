<?php include ("views/inc/headeri.php"); ?>
<title>We're beer for you!</title>
</head>
<body>
  <?php if(isset($_GET['bad'])){ echo '<div style= "background: #ec6e6e;padding: 0.5%;text-align:  center; font-size:  1.25em">Please login for site access.</div>';} ?>
  <div class="center-align">
    <img  src="img/logo.png" width="450px" height="300px">
  </div>
  <div class="section no-pad-bot" id="login">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form id="loginForm">
            <div class="card-content ">
              <span class="card-title center-align"><h4>Log in</h4></span>
              <div class="row">
                <div class="input-field col s12">
                  <label for="first_name">Email</label>
                  <input type="email" name="login_email" id="login_email" />
                </div>
                <div class="input-field col s12">
                  <label for="password">Password</label>
                  <input type="password" name="login_password" id="login_password" />
                </div>
              </div>
              <div class="row center-align">
                <button class="btn brown waves-effect waves-light">Login</button>
              </div>
            </div>
            <div class="card-action center-align">
              <a onclick="showRegister();">Don't have an account yet? Register now!</a>
            </div>
          </form>
          <div class="card-action center-align">
              <h5>Try out a new beer today!!</h5>
              <button id="searchLink" class="btn brown waves-effect waves-light">Search</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="section no-pad-bot" id="register">
    <div class="container">

      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form id="registerForm">
            <div class="card-content">
              <span onclick="showLogin();"> &#8592; Back </span>
              <span ><h4 class="card-title center-align">Register</h4></span>
              <div class="row">
                <div class="input-field col s12">
                  <label for="first_name">First Name</label>
                  <input type="text" class="validate" name="first_name" id="first_name" >
                </div>
                <div class="input-field col s12">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="validate" name="last_name" id="last_name">
                </div>
                <div class="input-field col s12">
                  <label for="email">Email address</label>
                  <input type="email" class="validate" name="email" id="email" >
                </div>
                <div class="input-field col s12">
                  <label for="password">Password </label>
                  <input type="password" class="validate" name="password" id="password">
                </div>
              </div>
            </div>
            <div class="card-action center-align">
              <button class="btn brown waves-effect waves-light">Register</button>
            </div>
            </form>

        </div>
      </div>
    </div>
  </div>
<?php include ("views/inc/footeri.php"); ?>