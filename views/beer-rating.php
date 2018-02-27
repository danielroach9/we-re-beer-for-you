<?php
require_once("../model/DB.class.php");
$db = new DB();
$rating = $db->getRecentRatings();
?>

<?php include 'inc/header.php'?>
  <title>WB4U | Beer Ratings</title>
<?php include 'inc/nav.php'?>

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
		    <td>
		      <a style="font-size:20px; font-weight:bold;"><?php echo$rating['beerID'] ?></a>
		      <span class="rating"><?php echo$rating['rating'] ?></span> &nbsp;
		      <div><a>brewery_name</a>
		      <span style="color:#8b8b8b;" class="location/origin">brewery_location</span></div>
		      <div style="color:#666;"><?php echo$rating['comments'] ?>
		      </div>
		      <span style="color:#8b8b8b;"><?php echo$rating['UUID'] ?></span><br><hr>
		    </td>
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

	  
<?php include 'inc/footer.php'?>