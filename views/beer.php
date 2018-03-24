<?php
require_once("../model/DB.class.php");

$db = new DB();
$beer = NULL;
$id = NULL;

if(!isset($_GET['id'])){
  while($beer == NULL) {
    $rand_num = mt_rand(1, 5901);
    $val = $db->getBeerInfoByID($rand_num);
    if(!empty($val['name'])) {
      $beer = $val;
      $id = $rand_num;
    }
  }
  $beer = $db->getBeerInfoByID($id);
  $ratings = $db->getRatingsByBeerId($id);
}
else {
  $id = $_GET['id'];
  $beer = $db->getBeerInfoByID($id);
  $ratings = $db->getRatingsByBeerId($id);
}

$users = $db->getAllUsers();

// pulling beer ratings hebrev
?>


<?php include 'inc/header.php'?>
<title>WB4U | <?php echo $beer['name']?></title>

<?php include 'inc/nav.php'?>
<div class="container-fluid">
  <div class="row">
    <div class="card-panel grey lighten-2 jumbotron center-align hoverable" id="beer-info">
      <h4><?php echo $beer['name'] ?></h4>
      <h4><a target="_blank" href="brewery.php?id=<?php echo $beer['brewery_id']?>"><?php echo $beer['brewery_name'] ?></a></h4>
      <h4>Category: <?php echo $beer['cat_name'] ?></h4>
      <h4>Style: <?php echo $beer['style_name'] ?></h4>
      <h4><i class="tooltipped fa fa-question-circle" data-position="left" data-delay="50" data-tooltip="Alcohol By Volume"></i>ABV: <?php echo $beer['abv'] ?>%</h4>
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
      <a class="waves-effect waves-light btn modal-trigger" href="#recommend"><i class="fa fa-share-square left"></i>Recommend</a>
    </div>
  </div>

  <div class="row" id="recent-reviews">
    <div class="card-panel grey lighten-2 hoverable">
      <?php
      foreach ($ratings as $review) {
        $from = $db->getUserByID($review->getID());
        $username = $from[0]->getWholeName();
        echo "
        <div>
        <div class='rating'>
        <span>
        <i class='fa fa-star'></i>
        <i class='".($review->getRating() >= 2 ? "fa fa-star" : "fa fa-star-0")."'></i>
        <i class='".($review->getRating() >= 3 ? "fa fa-star" : "fa fa-star-0")."'></i>
        <i class='".($review->getRating() >= 4 ? "fa fa-star" : "fa fa-star-0")."'></i>
        <i class='".($review->getRating() >= 5 ? "fa fa-star" : "fa fa-star-0")."'></i></span>"
        .$review->getRating()."
        </div>
        <span class='datetime-and-location'>".$review->getLocation()."</span>
        <span class='comment'>
        <p>".$review->getComment()."</p>
        </span>
        <span class='username'>".$username."</span>
        </div>
        <hr>
        ";
      }
      ?>
    </div>
  </div>
</div>
</div>

<div id="recommend" class="modal">
  <div class="modal-content">
    <form>
      <div class="row modal-row">
        <div class="input-field" id="subject">
          <i class="fa fa-envelope prefix"></i>
          <input disabled id="subject-input" type="text" value="Try <?php echo $beer['name']?>!"/>
          <label for="subject-input">Subject</label>
        </div>
      </div>
      <div class="row modal-row">
        <div class="input-field" id="send-to">
          <i class="fa fa-user-circle-o prefix"></i>
          <!-- <input id="send-to-input" type="text"/> -->
          <select id="send-to-input">
            <option value="" disabled selected>Choose a user to send the message!</option>
            <?php
            foreach ($users as $user) {
              if(!empty($user)){
                echo "<option value='".$user->getID()."''>".$user->getWholeName()."</option>";
              }
            }
            ?>
          </select>
          <label for="send-to-input">Send to</label>
        </div>
      </div>
      <div class="row modal-row">
        <div class="input-field" id="message">
          <i class="fa fa-pencil-square-o prefix"></i>
          <textarea id="message-area" class="materialize-textarea">I like this beer and think that you will like it too! &#13;&#10;It is called <?php echo $beer['name']?>.</textarea>
          <label for="message-area">Message</label>
        </div>
      </div>
    </form>
  </div>
  <div class="modal-footer">
    <a id="msg_cancel" href="#" class="modal-action modal-close btn-flat">Cancel</a>
    <a id="msg_send" href="#" class="modal-aciton modal-close btn-flat">Send</a>
  </div>
</div>

<?php include 'inc/footer.php'?>
