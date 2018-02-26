<?php
require_once("../model/DB.class.php");

$db = new DB();
$beer = NULL;
$id = $_GET['id'];

if ($id == 'random') {

  while($beer == NULL) {

    $rand_num = mt_rand(1, 5901);
    $val = $db->getBeerInfoByID($rand_num);
    if(!empty($val)) { $beer = $val; }
  }

}

else {
  $beer = $db->getBeerInfoByID($id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>WB4U | <?php echo $beer['name']?></title>

  <!-- CSS -->
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>
<body>

  <div class="container-fluid">
    <!-- Navbar-->
    <?php include 'inc/nav.php'?>
  </div>

  <div class="row">
    <div id="beer-info">
      <h4><?php echo $beer['name'] ?><a class="waves-effect waves-light btn"><i class="fas fa-share-square"></i></a>Recommend</h4>
      <h4><?php echo $beer['brewery_name'] ?></h4>
      <h4>Category: <?php echo $beer['cat_name'] ?></h4>
      <h4>Style: <?php echo $beer['style_name'] ?></h4>
      <p>
        <?php
        if(empty($beer['descript'])) {
          echo "No description given";
        }
        else {
          echo $beer['descript'];
        }
        ?>
      </p>
      <div style="text-align: center">
        <div class="col s2">
          <p style="margin: 0;">ABV</p>
          <i class="tooltipped fa fa-question-circle" data-position="right" data-delay="50" data-tooltip="Alcohol By Volume">
          </i>
          <p style="margin: 0;"><?php echo $beer['abv'] ?>%</p>
        </div>
      </div>
    </div>

    <div id="recent-reviews">
      <p class=""style="font-style: light-italic;">Recent Activity</p>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../js/materialize.min.js"></script>

</body>
</html>
