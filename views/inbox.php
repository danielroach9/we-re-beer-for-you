<?php
session_start();
require_once ("../model/DB.class.php");

$db = new DB();
$messages = $db->getMessagesForUser($_SESSION['accountID']);
?>

<?php include 'inc/header.php'?>

<title> WB4U | Daniels Inbox </title>
<?php include 'inc/nav.php'?>
<div class="container-fluid">
	<div class="row">
		<div class="col s10">
			<table class="bordered centered">
				<thead>
					<tr>
						<th>Title</th>
						<th>From</th>
						<th>Message</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($messages as $message) {
							$from = $db->getUserByID($message->getSenderID());
							$from[0]->getWholeName();
								echo "
								<tr>
									<td>".$message->getTitle()."</td>
									<td>".$from[0]->getWholeName()."></td>
									<td>".$message->getContent()"</td>
								</tr>
							";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
