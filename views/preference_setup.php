<?php
require_once("../model/DB.class.php");

$db = new DB();
$categories = $db->getCategories();
$countries = $db->getCountries();
$styles = $db->getStylesByCategory(1); //hardcoded parameter to start
$fname = isset($_SESSION['accountFirstName']) ? $_SESSION['accountFirstName'] : null;
$lname = isset($_SESSION['accountLastName']) ? $_SESSION['accountLastName'] : null;

?>

<?php include "inc/header.php"; ?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form id="preferenceForm">
            <div class="card-content">
              <span class="card-title center-align">Try a new Beer!</span>
              <div class="row">
                <div class="input-field col s12">
                  <label for="preferred_abv_range">Preferred ABV</label>
                  <br>
                  <div class="slidecontainer">
                    <input type="range" min="1" max="40" step="0.1" value="5" class="slider" id="abvRange">
                    <p>ABV: <span id="abvPrint"></span></p>
                  </div>
                </div>
                <div class="input-field col s12">
                  <select name="category" id="selectedCategory">
                  <?php
                    foreach ($categories as $value) {
                      echo '<option value='.$value[id].'>'.$value[cat_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_category">Prefered Category</label>
                </div>
                <div class="input-field col s12">
                  <select name="styles" id="stylesDropdown">
                  <?php
                    foreach ($styles as $value) {
                      echo '<option value='.$value[id].'>'.$value[style_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_style">Prefered Style</label>
                </div>
                <div class="input-field col s12">
                  <select name="select" id="countryDropdown">
                 <?php
                    foreach ($countries as $value) {
                      $count = 1;
                      echo '<option value='.$count.'>'.$value[country].'</option>';
                      $count++;
                    }
                    ?>
                    </select>
                    <label for="preferred_country">Preferred Country</label>
                </div>
              </div>
            </div>
            <div class="card-action center-align">
              <button class="btn brown waves-effect waves-light">Show me some beers!</button>
            </div>
            </form>
            <div id="results">
              <div class="row">
                
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var slider = document.getElementById("abvRange");
    var output = document.getElementById("abvPrint");
    output.innerHTML = slider.value+'%';

    slider.oninput = function() {
      output.innerHTML = this.value+'%';
    }
  </script>
<?php include "inc/footer.php"; ?>
