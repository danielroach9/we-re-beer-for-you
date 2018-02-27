<?php
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

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <title>WB4U | Beer Ratings</title>
</head>

	<body>

	<h1>Beer Ratings: Recent</h1>

		<div class="btn-group" stype="width:100%">
		  <button style="width:20%">Recent</button>
		  <button style="width:20%">New</button>
		  <button style="width:20%">Favorites</button>
		  <button style="width:20%">Popular</button>
		  <button style="width:20%">Local</button>
		</div>

		<table class="table" style="padding-right:20px;padding-top:100px;">
		<tbody>
		  <tr>
		    <td valign="top" align="center">
		      <!-- This is for image of beer -->
		    </td>
		    <?php
		      foreach( $ratings as $rating ){
			echo
		      	"<td>" . $rating->getID . "</td>";
		    	"<td>" . $rating->getLocation . "</td>";
			"<td>" . $rating->getRating . "</td>";
			"<td>" . $rating->getComments . "</td>";
			"<td>" . $rating->getBeerID . "</td>";
			"<td>" . $rating->getPurchaseID . "</td>";
		      }
		    ?>
		    <!--<td>
		      <a style="font-size:20px; font-weight:bold;"><?php echo$rating['beerID'] ?></a>
		      <span class="rating"><?php echo$rating['rating'] ?></span> &nbsp;
		      <div><a>brewery_name</a>
		      <span style="color:#8b8b8b;" class="location/origin">brewery_location</span></div>
		      <div style="color:#666;"><?php echo$rating['comments'] ?>
		      </div>
		      <span style="color:#8b8b8b;"><?php echo$rating['UUID'] ?></span><br><hr>
		    </td>-->
		  </tr>

		  <tr>
		    <td valign="top" align="center">
		      <!-- This is for image of beer -->
		    </td>
		    <td>
		      <a style="font-size:20px; font-weight:bold;">Blue Moon Pacific Apricot Wheat</a>
		      <span class="rating">2.4</span> &nbsp;
		      <div><a>Blue Moon Brewing Company (MillerCoors)</a>
		      <span style="color:#8b8b8b;" class="location/origin">Denver, Colorado</span></div>
		      <div style="color:#666;">12 oz. bottle. Appearance is an orange cloudy color, fast dying head. Aroma is artificial apricot, straw and malted wheat. <br><br> Mouthfeel is light without any sugar but... The fruit definitely has a slightly fake taste to it. Wheat backbone / straw is thin as is the texture. No need to say any more here.
		      </div>
		      <span style="color:#8b8b8b;">aUserName</span><br><hr>
		    </td>
		  </tr>
		</tbody>
		</table>

	  
	</body>
</html>
