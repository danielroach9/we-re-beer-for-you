<?php
if(isset($_SESSION['loggedIn'])){
  if($_SESSION['loggedIn'] == true){
    
  }
}else{
  header("Location: http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/index.php?bad=true");
}

require_once("../model/DB.class.php");
$db = new DB();
$beers = $db->getAllBeers();
?>

<!DOCTYPE HTML> 

<style>
.error {color: #FF0000;}

.txt-center {
  text-align: center;
}
.hide {
  display: none;
}

.clear {
  float: none;
  clear: both;
}

.rating {
    width: 90px;
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
}

.rating > label {
    float: right;
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.1em;
    cursor: pointer;
    color: #000;
}

.rating > label:hover,
.rating > label:hover ~ label,
.rating > input.radio-btn:checked ~ label {
    color: transparent;
}

.rating > label:hover:before,
.rating > label:hover ~ label:before,
.rating > input.radio-btn:checked ~ label:before,
.rating > input.radio-btn:checked ~ label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #FFD700;
}
</style>

<?php include "inc/header.php"; ?>
<title>We're beer for you!</title>
<?php include "inc/nav.php"; ?>

<div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <div class="valign-wrapper row login-box">
        <div class="card hoverable col s6 offset-s3">
          <form id="beerRatingForm">
            <div class="card-content">
              <span class="card-title center-align">Submit Beer Review</span>
	      <p><span class="error">* required field.</span></p>
              <div class="row">
                <div class="input-field col s12">
                  <label for="first_name">Beer name</label>
                  <input type="text" name="beerID" id="beerID" >
		  <span class="error">*</span>
                </div>

		<div class="input-field col s12">
                  <select name="beerName" id="beerName">
                  <?php
                    foreach ($beers as $beer) {
                      echo '<option value=' . $beer['name'] . '</option>';
                    }
                    ?>
                    </select>
                    <label for="beer">Beer</label>
                </div>

                <div class="input-field col s12">
                  <label for="location">Location</label>
                  <input type="text" name="location" id="location">
		  <span class="error">*</span>
                </div>
		 <label for="rating">Rating</label>
                 <div class="rating">
		    <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
		    <label for="star5" >☆</label>
		    <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
		    <label for="star4" >☆</label>
		    <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
		    <label for="star3" >☆</label>
		    <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
		    <label for="star2" >☆</label>
		    <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
		    <label for="star1" >☆</label>
		    <div class="clear"></div>
		    <span class="error"></span>
        	</div>
		<label for="comment">Comment</label>
		<div class="input-field col s12">		
		    <textarea rows="4" cols="50" placeholder="Enter comment here..." name="comment" id="comment">
	    	    </textarea>
		</div>
              </div>
            </div>
	    <div class="card-action center-align">
              <input type="submit" class="btn brown waves-effect waves-light" value="Submit Rating">
            </div>
            </form>
	    

		</div>
	      </div>
	    </div>
	  </div>
	<?php include "inc/footer.php"; ?>

