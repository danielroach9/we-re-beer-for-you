<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/styles.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

<?php include ("views/inc/header.php"); ?>
<title>We're beer for you!</title>
</head>
<body>
  <div class="center-align">
    <img  src="img/logo.png" width="450px" height="300px">
  </div>
  <div class="section no-pad-bot" id="login">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form>
            <div class="card-content ">
              <span class="card-title center-align"><h4>Log in</h4></span>
              <div class="row">
                <div class="input-field col s12">
                  <label for="first_name">First Name</label>
                  <input type="text" class="validate" name="first_name" id="first_name" />
                </div>
                <div class="input-field col s12">
                  <label for="password">Password </label>
                  <input type="password" class="validate" name="password" id="password" />
                </div>
              </div>
              <div class="row center-align">
                <input type="submit" class="btn brown waves-effect waves-light" value="Login">
              </div>
            </div>
            <div class="card-action center-align">
              <a onclick="showRegister();">Don't have an account yet? Register now!</a>
            </div>
            <div class="card-action center-align">
              <h5>Try out a new beer today!!</h5>
              <input type="submit" class="btn brown waves-effect waves-light" value="Search">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="section no-pad-bot" id="register">
    <div class="container">
      
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form>
            <div class="card-content">
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
              <input type="submit" class="btn brown waves-effect waves-light" value="Register">
            </div>
            </form>

        </div>
      </div>
    </div>
  </div>

  <footer class="page-footer brown">
    <div class="footer-copyright brown">
      <div class="container">
      We're beer for you - &copy;Copyright 2018 | <a class="orange-text text-lighten-3" href="https://github.com/danielroach9/we-re-beer-for-you">View Source</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->


  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script>
    $( document ).ready(function(){
        $(".button-collapse").sideNav();
    });

    function showRegister(){
      $("#register").show();
      $("#login").hide();
    }

  </script>

  </body>
</html>
