<?php
require_once("DB.class.php");

$db = new DB();

$user = $db->getAllUsers();

echo "<pre>";
print_r($user);
echo "</pre>";