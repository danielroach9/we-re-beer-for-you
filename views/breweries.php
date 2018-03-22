<?php
require_once("../model/DB.class.php");

$db = new DB();

$breweries = $db->getAllBreweries();

$breweries_a = array_filter($breweries, function($key) {
  return ($key['name'][0] == "A" || $key['name'][0] == "a");
}, ARRAY_FILTER_USE_BOTH);

$breweries_b = array_filter($breweries, function($key) {
  return ($key['name'][0] == "B" || $key['name'][0] == "b");
}, ARRAY_FILTER_USE_BOTH);

$breweries_c = array_filter($breweries, function($key) {
  return ($key['name'][0] == "C" || $key['name'][0] == "c");
}, ARRAY_FILTER_USE_BOTH);

$breweries_d = array_filter($breweries, function($key) {
  return ($key['name'][0] == "D" || $key['name'][0] == "d");
}, ARRAY_FILTER_USE_BOTH);
?>

<?php include 'inc/header.php'?>
<title>WB4U | Breweries</title>
<?php include 'inc/nav.php'?>
<div class="container-fluid">
  <div class="row card-panel">
    <ul class="tabs center-align">
      <!-- No breweries with first letter X-->
      <li class="tab"><a class="active" href="#breweries_a">A</a></li>
      <li class="tab "><a href="#!">B</a></li>
      <li class="tab"><a href="#!">C</a></li>
      <li class="tab"><a href="#!">D</a></li>
      <li class="tab"><a href="#!">E</a></li>
      <li class="tab"><a href="#!">F</a></li>
      <li class="tab"><a href="#!">G</a></li>
      <li class="tab"><a href="#!">H</a></li>
      <li class="tab"><a href="#!">I</a></li>
      <li class="tab"><a href="#!">J</a></li>
      <li class="tab"><a href="#!">K</a></li>
      <li class="tab"><a href="#!">L</a></li>
      <li class="tab"><a href="#!">M</a></li>
      <li class="tab"><a href="#!">N</a></li>
      <li class="tab"><a href="#!">O</a></li>
      <li class="tab"><a href="#!">P</a></li>
      <li class="tab"><a href="#!">Q</a></li>
      <li class="tab"><a href="#!">R</a></li>
      <li class="tab"><a href="#!">S</a></li>
      <li class="tab"><a href="#!">T</a></li>
      <li class="tab"><a href="#!">U</a></li>
      <li class="tab"><a href="#!">V</a></li>
      <li class="tab"><a href="#!">W</a></li>
      <li class="tab"><a href="#!">Y</a></li>
      <li class="tab"><a href="#!">Z</a></li>
      <li class="tab"><a href="#!">0-9</a></li>
    </ul>
    <div id="breweries_a">
      <div class="row brewery-listing">
        <?php
        foreach($breweries_a as $brewery) {
          echo "
            <div class='col s3'>
              <div class='card beer-card'>
                <div class='card-content center-align'>
                  <a href='brewery.php?id=$brewery[id]'>
                    <span class='card-title'>$brewery[name]</span>
                  </a>
                  <p>$brewery[city], $brewery[state]</p>
                  <p>$brewery[country]</p>
                </div>
              </div>
            </div>
          ";
        }
         ?>
      </div>
    </div>
  </div>
</div>
