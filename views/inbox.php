<?php
require_once ("../model/DB.class.php");

$db = new DB();
$messages = $db->getMessagesForUser($_SESSION['accountID']);
?>

<?php include 'inc/header.php'?>

<title> WB4U | Daniels Inbox </title>
<?php include 'inc/nav.php'?>
	<div class="row">
			<div class="card hoverable col s12">
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
										<td>".$from[0]->getWholeName()."</td>
										<td>".$message->getContent()."</td>
										<td>".$message->getDate()."</td>
									</tr>
								";
							}
						?>
					</tbody>
				</table>
	</div>
</div>
<?php include 'inc/footer.php'?>