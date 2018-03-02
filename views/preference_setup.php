<?php
require_once("../model/DB.class.php");

$db = new DB();
$categories = $db->getCategories();
$countries = $db->getCountries();
$styles = $db->getStylesByCategory(1); //hardcoded parameter to start


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <!-- <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

<?php include "inc/headeri.php"; ?>
<title>We're beer for you!</title>

</head>
<body>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form>
            <div class="card-content">
              <span class="card-title center-align">Preferences</span>
              <div class="row">
                <div class="input-field col s12">
                  <label for="preferred_abv_range">ABV Range</label>
                  <input type="text" class="preferences" name="preferred_abv_range" id="preferred_abv_range" >
                  <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange">
                  </div>
                </div>
                <div class="input-field col s12">
                  <label for="preferred_category">Prefered Category</label>
                  <input type="text" class="preferences" name="preferred_category" id="preferred_category" >
                  <select name="select" id="selectedCategory">
                  <?php
                    foreach ($categories as $value) {
                      echo '<option value='.$value[id].'>'.$value[cat_name].'</option>';
                    }
                    ?>
                    </select>
                </div>
                <div class="input-field col s12">
                  <label for="preferred_style">Prefered Style</label>
                  <input type="text" class="preferences" name="preferred_style" id="preferred_style">
                  <p>yo</p>
                  <select>
                    <option value=1>test</option>

                    </select>
                </div>
                <div class="input-field col s12">
                  <label for="preferred_country">Preferred Counrty</label>
                  <input type="text" class="preferences" name="preferred_country" id="preferred_country">
                  <select name="select">
                  <?php
                    foreach ($countries as $value) {
                      $count = 1;
                      echo '<option value='.$count.'>'.$value[country].'</option>';
                      $count++;
                    }
                    ?>
                    </select>
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
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="https://github.com/danielroach9/we-re-beer-for-you">We're beer for you</a>
      - &copy; Copyright <?php echo date("Y"); ?>
      </div>
    </div>
  </footer>


  <!--  Scripts-->


  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script>
    $( document ).ready(function(){
        $('#selectedCategory').on('change',function(){
          var cat_id = $(this).val();
          var styles;
          $.ajax({
            type: 'GET',
            url: '../model/DB.class.php',
            data: {functionname: 'getStylesByCategory', arguments: cat_id},
            success: function (obj, textstatus){
              styles = obj;
            }
          });
          console.log(styles);

        });
    });
  </script>

  </body>
</html>
