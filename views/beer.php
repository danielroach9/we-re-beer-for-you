<?php
require_once("../model/DB.class.php");

define("ABV_def", "ABV or Alcohol by volume is a standard measure of
  how much alcohol is containted in a given volume of an alcoholic
  beverage. It is defined as the number of millilitres (mL) of pure ethanol present
  in 100 mL.");

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
  <title>WB4U | Beer</title>

  <!-- CSS -->
  <link href="../css/materialize.min.css" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

</head>
<body>

  <div class="container-fluid">
    <!-- Navbar-->
    <nav>
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">We're Beer For You</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="file1.php"></a>File 1</li>
          <li><a href="file2.php"></a>File 2</li>
          <li><a href="file3.php"></a>File 3</li>
        </ul>
      </div>
    </nav>
  </div>

  <div class=row>
    <div class="col s9">
      <div class="col s6">

        <h4><?php echo $beer['name'] ?></h4>
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
              <i class="tooltipped fa fa-question-circle" data-position="right" data-delay="50" data-tooltip="<?php echo ABV_def?>">
              </i>
              <p style="margin: 0;"><?php echo $beer['abv'] ?>%</p>
            </div>
        </div>
      </div>
      <div class="col s3">

      </div>
    </div>
    <div class="col s3">
      <p class=""style="font-style: light-italic; text-align: center">Recent Activity</p>
    </div>
  </div>

  <script src="../js/materialize.min.js"></script>

</body>
</html>
