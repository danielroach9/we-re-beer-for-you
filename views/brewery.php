<?php
require_once("../model/DB.class.php");

$db = new DB();
$id = $_GET['id'];

$brewery = $db->getBreweryInfoByID($id);
$brewery_beers = $db->getBeersByBrewery($id);
 ?>

 <!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>WB4U | <?php echo $brewery['name']?></title>

  <!-- CSS -->
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body>

<div class="container-fluid">
  <!-- Navbar-->
  <?php include 'inc/nav.php'?>

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
      foreach ($brewery_beers as $value) {
        echo "<div class='card small'>
          <div class='card-content white-text'>
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

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.min.js"></script>
</body>
</html>
