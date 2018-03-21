<?php
require_once("../model/DB.class.php");

$db = new DB();
$ratings = $db->getRecentRatings();
$fname = isset($_SESSION['accountFirstName']) ? $_SESSION['accountFirstName'] : null;
$lname = isset($_SESSION['accountLastName']) ? $_SESSION['accountLastName'] : null;

?>

<?php include "inc/header.php"; ?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>

<div class="section no-pad-bot" id="index-banner">
  <div class="container">
    <div class="valign-wrapper row login-box">
      <div class="card hoverable col s6 offset-s3">
          <div class="card-content">
            <span class="card-title center-align">My Beer Reviews</span>


            <table class="table" style="padding-right:20px;padding-top:100px;">
              <tbody>
                <tr>
                  <?php
                  foreach( $ratings as $rating ){
                    $from = $db->getUserByID($rating->getID());
                    $username = $from[0]->getWholeName();

                    $beer = $db->getBeerByID($rating->getBeerID());
                    $beerName = $beer['name'];

                    echo
                    "<a style='font-size:20px; font-weight:bold;'>" . $beerName . "</a>
                    <div class=rating>
                    <span>
                    <i class='fa fa-star'></i>
                    <i class='".($rating->getRating() >= 2 ? "fa fa-star" : "fa fa-star-0")."'></i>
                    <i class='".($rating->getRating() >= 3 ? "fa fa-star" : "fa fa-star-0")."'></i>
                    <i class='".($rating->getRating() >= 4 ? "fa fa-star" : "fa fa-star-0")."'></i>
                    <i class='".($rating->getRating() >= 5 ? "fa fa-star" : "fa fa-star-0")."'></i>
                    </span>"
                    . $rating->getRating() .
                    "</div>
                    <div>
                    <span style='color:#8b8b8b;' class='location/origin'>" . $rating->getLocation() . "</span>
                    </div>
                    <div style='color:#666;'>"
                    . $rating->getComment() .
                    "</div>
                    <span class='username'>" . $username . "</span>
                    </div><br><hr>"
                    ;}
                    ?>

                  </tr>

                </tbody>
              </table>


            </body>

          </div>
        </div>
      </div>
    </div>
<?php include "inc/footer.php"; ?>
