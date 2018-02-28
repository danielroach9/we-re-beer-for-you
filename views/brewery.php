<?php
require_once("../model/DB.class.php");

$db = new DB();
$id = $_GET['id'];

$brewery = $db->getBreweryInfoByID($id);
$brewery_beers = $db->getBeersByBrewery($id);
 ?>

<?php include 'inc/header.php'?>

<title> WB4U | <?php echo $brewery['name']?></title>
<?php include 'inc/nav.php'?>
<div class="container-fluid">
  <!-- Navbar-->

  <div class="row">
    <div id="brewery-info">
      <h4><?php echo $brewery['name']?></h4>
      <h4><a target="_blank"><?php echo $brewery['website']?></a></h4>
      <h4><?php echo $brewery['address1'] ?></h4>
      <h4><?php echo $brewery['city']?>, <?php echo $brewery['state']?> <?php echo $brewery['code']?></h4>
      <h4><?php echo $brewery['phone'] ?></h4>
    </div>
  </div>
  <div class="row">
    <div class="col s9" id="beers-listing">
      <?php
      // echo "<pre>".print_r($brewery_beers)."</pre>";
      foreach ($brewery_beers as $value) {
        echo "<div class='card small'>
          <div class='card-content'>
          <span class='card-title'>$value[name]</span>
          <p>Category: $value[cat_name]</p>
          <p>Style:  $value[style_name]</p>
          </div>
        </div>";
      }
      ?>
    </div>
  </div>
</div>

<?php include 'inc/footer.php'?>
