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
                  <label for="preferred_abv_range">ABV Range</label>
                  <input type="text" class="preferences" name="preferred_abv_range" id="preferred_abv_range" >
                  <div class="slidecontainer">
                    <input type="range" min="1" max="100" value="50" class="slider" id="abvRange">
                  </div>
                </div>
                <div class="input-field col s12">
                  <input type="text" class="preferences" name="preferred_category" id="preferred_category" >

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
                  <input type="text" class="preferences" name="preferred_country" id="preferred_country">
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
              <input type="submit" class="btn brown waves-effect waves-light" value="Register">
            </div>
            </form>

        </div>
      </div>
    </div>
  </div>
<?php include "inc/footer.php"; ?>
