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

$users = $db->getAllUsers();
?>


<?php include 'inc/header.php'?>
  <title>WB4U | <?php echo $beer['name']?></title>

<?php include 'inc/nav.php'?>
  <div class="container-fluid">
    <div class="row">
    <div id="beer-info">
      <h4><?php echo $beer['name'] ?>
        <a class="waves-effect waves-light btn modal-trigger" href="#recommend"><i class="fa fa-share-square left"></i>Recommend</a>
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
          <div class=rating>
            <span>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star-o"></i>
              4
            </div>
            <span class="datetime-and-location">Finnegan's Pub @ 03/01/2018 3:30 PM</span>
            <span class="comment">
              <p>
                12 oz. bottle. Appearance is an orange cloudy color, fast dying head. Aroma is artificial apricot, straw and malted wheat.
                Mouthfeel is light without any sugar but... The fruit definitely has a slightly fake taste to it. Wheat backbone / straw is thin as is the texture. No need to say any more here.
              </p>
            </span>
            <span class="username">dxr5716</span>
          </div>
          <hr>
          <div id="review2">
            <div class=rating>
              <span>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
                4
              </div>
              <span class="datetime-and-location">Finnegan's Pub @ 03/01/2018 3:30 PM</span>
              <span class="comment">
                <p>
                  12 oz. bottle. Appearance is an orange cloudy color, fast dying head. Aroma is artificial apricot, straw and malted wheat.
                  Mouthfeel is light without any sugar but... The fruit definitely has a slightly fake taste to it. Wheat backbone / straw is thin as is the texture. No need to say any more here.
                </p>
              </span>
              <span class="username">dxr5716</span>
            </div>
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
                  echo "<option value='".$user->getID()."''>".$user->getWholeName()."<option>";
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
