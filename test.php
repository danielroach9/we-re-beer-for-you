<?php
require_once("DB.class.php");

$db = new DB();

$user = $db->getAllUsers();

echo "<pre>";
print_r($user);
echo "</pre>";

echo "=========================================";

$beer = $db->getBeerByID(90);

echo "<pre>";
print_r($beer);
echo "</pre>";


echo "=========================================";

$beerInfo = $db->getBeerInfoByID(90);

echo "<pre>";
print_r($beerInfo);
echo "</pre>";

echo "=========================================";

$beerName = $db->getBeerInfoByName("%corona%");

echo "<pre>";
print_r($beerName);
echo "</pre>";