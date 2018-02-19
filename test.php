<?php
require_once("model/DB.class.php");

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
echo "\nBeer Info by ID";
$beerInfo = $db->getBeerInfoByID(90);

echo "<pre>";
print_r($beerInfo);
echo "</pre>";

echo "=========================================";
echo "\nBeer Info By Name";

$beerName = $db->getBeerInfoByName("%corona%");

echo "<pre>";
print_r($beerName);
echo "</pre>";

echo "=========================================";
echo "\nBrewery Info";

$brewery = $db->getBreweryInfoByID(90);

echo "<pre>";
print_r($brewery);
echo "</pre>";

echo "=========================================";
echo "\nBrewery Beers";

$breweryBeers = $db->getBeersByBrewery(3);

echo "<pre>";
print_r($breweryBeers);
echo "</pre>";