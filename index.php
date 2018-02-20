<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

<?php include ("views/inc/header.php"); ?>
<title>We're beer for you!</title>
<style>
  html,
  body,
  .login-box {
    height: 100%;
  }
  .footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 60px;
  background-color: #f5f5f5;
}
  .card{
    width: 600px;
  }
  .card-action{
    margin-bottom: 20px;
  }


</style>
</head>
<body>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form>
            <div class="card-content">
              <span class="card-title">Log in</span>
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
            </div>
            <div class="card-action center-align">
              <input type="submit" class="btn brown waves-effect waves-light" value="Login">
            </div>
            <div class="card-action center-align">
              <a href="views/register.php"> Don't have an account yet? Register now! </a>
            </div>
            <div class="card-action center-align">
              <h5> Try out a new beer today!! </h5>
              <input type="submit" class="btn brown waves-effect waves-light" value="Search">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
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
  </script>

  </body>
</html>
