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


<?php include 'inc/header.php'?>
  <title>WB4U | <?php echo $beer['name']?></title>

<?php include 'inc/nav.php'?>
  <div class="container-fluid">
    <div class="row">
    <div id="beer-info">
      <h4><?php echo $beer['name'] ?>
        <a class="waves-effect waves-light btn" href="#recommend-modal"><i class="fa fa-share-square left"></i>Recommend</a>
      </h4>
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
        <div class="col s2 center-align">
          <p style="margin: 0;">ABV</p>
          <i class="tooltipped fa fa-question-circle" data-position="right" data-delay="50" data-tooltip="Alcohol By Volume">
          </i>
          <p style="margin: 0;"><?php echo $beer['abv'] ?>%</p>
        </div>
      </div>
    </div>

    <div class="row" id="recent-reviews">
      <div class="card-panel grey lighten-2">
        <div id="review1">
          <div id=rating>
            <span>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
              4
            </span>
          </div>
        </div>
        <hr />
        <div id="review2">

        </div>
      </div>
      <p class=""style="font-style: light-italic;">Recent Activity</p>

    </div>
  </div>

  <div id="recommend-modal" class="modal">
  <div class="modal-content">
    <h4>'Beer Name here' Recommendation</h4>
      <p>blah blah blah</p>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close btn-flat">Cancel</a>
    <a href="#!" class="modal-aciton modal-close btn-flat">Send</a>
  </div>
</div>

  <?php include 'inc/footer.php'?>
