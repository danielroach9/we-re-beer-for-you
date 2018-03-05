<?php
require_once ("../model/DB.class.php");

$db = new DB();
$messages = $db->getMessagesForUser($SESSION['accountID']);
?>

<?php include 'inc/header.php'?>

<title> WB4U | Daniels Inbox </title>
<?php include 'inc/nav.php'?>
<div class="container-fluid">
	<?php 
		foreach ($messages as $message) {
			/*
				$from = $db->getUserByID($message->getSenderID());
				$from[0]->getWholeName();
				$message->getTitle();
				$message->getContent();
			 */
		}
	?>
</div>
