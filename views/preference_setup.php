<?php
require_once("../model/DB.class.php");

$db = new DB();
$categories = $db->getCategories();
$countries = $db->getCountries();
$styles = $db->getStylesByCategory(1); //hardcoded parameter to start


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
              <span class="card-title center-align">Preferences</span>
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
                  <select name="select1" id="selectedCategory">
                  <?php
                    foreach ($categories as $value) {
                      echo '<option value='.$value[id].'>'.$value[cat_name].'</option>';
                    }
                    ?>
                    </select>
                    <label for="preferred_category">Prefered Category</label>
                </div>
                <div class="input-field col s12">
                  <select name="select" id="stylesDropdown">
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
              <input type="submit" class="btn brown waves-effect waves-light" value="Show me the beer!!">
            </div>
            </form>
            <p>Preferred Beers</p>
            <p id="preferredBeers">test</p>

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
