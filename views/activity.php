<?php
if(isset($_SESSION['loggedIn'])){
	if($_SESSION['loggedIn'] == true){
		
	}
}else{
	header("Location: http://serenity.ist.rit.edu/~ajp8707/we-re-beer-for-you/index.php?bad=true");
}

 include ("views/inc/header.php"); ?>
<title> WB4U - Activity </title>
<?php include ("views/inc/nav.php"); ?>
<div class=container-fluid>

</div>
<?php include ("views/inc/footer.php"); ?>
