<?php
if(isset($_SESSION['loggedIn'])){
	if($_SESSION['loggedIn'] == true){
		
	}
}else{
	header("Location: http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/index.php?bad=true");
}

require_once("../model/DB.class.php");
$db = new DB();
$ratings = $db->getRecentRatings();
?>

<!DOCTYPE html>
<html lang="en">

<style>
.btn-group button {
    background-color: #1d64c5; /* Green background */
    border: 1px solid blue; /* Green border */
    color: white; /* White text */
    padding: 10px 24px; /* Some padding */
    cursor: pointer; /* Pointer/hand icon */
    float: left; /* Float the buttons side by side */
}

/* Clear floats (clearfix hack) */
.btn-group:after {
    content: "";
    clear: both;
    display: table;
}

.btn-group button:not(:last-child) {
    border-right: none; /* Prevent double borders */
}

/* Add a background color on hover */
.btn-group button:hover {
    background-color: #3e8e41;
}
</style>
<!--
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>WB4U | Beer Ratings</title>
</head>

	<body>

	<h1>Beer Ratings: Recent</h1>
-->
<?php include "inc/header.php"; ?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form id="beerRatingForm">
            <div class="card-content">
              <span class="card-title center-align">Beer Reviews</span>


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
</html>
<?php include "inc/footer.php"; ?>

