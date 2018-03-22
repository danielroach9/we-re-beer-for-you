<?php
require_once("../model/DB.class.php");

$db = new DB();

function filterArrayByLetter($letter) {
  return (this->name[0] == $letter);
}

$breweries = $db->getAllBreweries();

$breweries_a = array_filter($breweries, 'filterArrayByLetter');

var_dump($breweries_a);
?>

<?php include 'inc/header.php'?>
<title>WB4U | Breweries</title>
<?php include 'inc/nav.php'?>
<div class="container-fluid">
  <div class="row card-panel">
    <ul class="tabs center-align">
      <!-- No breweries with first letter X-->
      <li class="tab"><a class="active" href="#!">A</a></li>
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
    <!-- <div class="collection"></div> -->
  </div>
</div>
