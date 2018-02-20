<?php
require_once("../model/DB.class.php");

$db = new DB();
$id = $_GET['id'];

$brewery = $db->getBreweryInfoByID($id);
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
      <a target="_blank"><?php echo $brewery['website']?></a>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.min.js"></script>
</body>
</html>
