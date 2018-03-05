<!DOCTYPE HTML> 
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  


<?php
// define variables and set to empty values
$beerErr = $locationErr = "";
$beer_id = $location = $comment = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["beer_id"])) {
    $beerErr = "Beer Name is required";
  } else {
    $beer_id = test_input($_POST["beer_id"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$beer_id)) {
      $beerErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["location"])) {
    $locationErr = "Location is required";
  } else {
    $location = test_input($_POST["location"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$location)) {
      $locationErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return data;
}
    
?>

<h2>Submit Beer Review</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="/action_page.php">
  Beer name:<br>
  <input type="text" name="beername" value="<?php echo $beer_id;?>">
  <span class="error">* <?php echo $beerErr;?></span>
  <br><br>
  Location:<br>
  <input type="text" name="location" value="<?php echo $location;?>">
  <span class="error">* <?php echo $locationErr;?></span>
  <br><br>
  Rating:<br>
  <input type="radio" name="rating" value="1"> 1<br>
  <input type="radio" name="rating" value="2"> 2<br>
  <input type="radio" name="rating" value="3"> 3<br>
  <input type="radio" name="rating" value="4"> 4<br>
  <input type="radio" name="rating" value="5" checked> 5<br>
  <input type="submit" name="submit" value="Submit">
</form> 

<br><br>
<textarea rows="4" cols="50" placeholder="Enter comment here..." name="comment" value="<?php echo $comment;?>" form="usrform">
</textarea>

<?php
    echo "<h2> Test Input <?h>";
    echo $beer_id;
    echo "<br>";
    echo $location;
    echo "<br>";
    echo $comment;
?>

</body>
</html>
