<?php
require_once("../model/DB.class.php");

$db = new DB();

$brewery = NULL;
$id = $_GET['id'];

if(!$_GET['id']){
  
  while($beer == NULL) {
    $rand_num = mt_rand(1, 5901);
    $val = $db->getBreweryInfoByID($rand_num);
    if(!empty($val)) {
      $beer = $val;
      $id = $rand_num;
    }
  }
  $brewery = $db->getBreweryInfoByID($id);
  $brewery_beers = $db->getBeersByBrewery($id);
}
else {
  $id = $_GET['id'];
  $brewery = $db->getBreweryInfoByID($id);
  $brewery_beers = $db->getBeersByBrewery($id);
}

 ?>

<?php include 'inc/header.php'?>

<title> WB4U | <?php echo $brewery['name']?></title>
<?php include 'inc/nav.php'?>
<div class="container-fluid">
  <!-- Navbar-->

  <div class="row">
    <div class="card-panel grey lighten-2 jumbotron center-align" id="brewery-info">
      <h4><?php echo $brewery['name']?></h4>
      <h4><a target="_blank" href="<?php echo $brewery['website']?>"><?php echo $brewery['website']?></a></h4>
      <h4><?php echo $brewery['address1'] ?></h4>
      <h4><?php echo $brewery['city']?>, <?php echo $brewery['state']?> <?php echo $brewery['code']?></h4>
      <h4><?php echo $brewery['phone'] ?></h4>
    </div>
  </div>

  <div class="row" id="listing-divider">
    <div class="center-align">
      <hr />
        <h5 class="brand-logo">Made by <?php echo $brewery['name']?></h5>
      <hr />
    </div>
  </div>

  <div class="row" id="beers-listing">
      <?php

      foreach ($brewery_beers as $value) {
        echo "
          <div class='col s4'>
          <div class='card beer-card'>
          <div class='card-content center-align'>
          <a href='beer.php?id=$value[id]'><span class='card-title'>$value[name]</span></a>
          <p>Category: $value[cat_name]</p>
          <p>Style:  $value[style_name]</p>
          </div>
        </div>
        </div>";
      }
      ?>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'?>
