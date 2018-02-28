<?php
require_once("model/DB.class.php");

$db = new DB();

echo "=========================================";
echo "\n All Users";
$user = $db->getAllUsers();

echo "<pre>";
print_r($user);
echo "</pre>";

echo "=========================================";
echo "\n User ID";
$userID = $db->getUserByID(1);

echo "<pre>";
print_r($userID);
echo "</pre>";

/*echo "=========================================";
echo "\n Insert new User ";
$userInsert = $db->insertNewUser("Test", "Tester","test@test.com","test", 1);

echo "<pre>";
print_r($userInsert);
echo "</pre>";*/

echo "=========================================";
echo "\n All Users";
$user = $db->getAllUsers();

echo "<pre>";
print_r($user);
echo "</pre>";

echo "=========================================";
echo "\nBeer by ID";
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

echo "=========================================";
echo "\n Insert new Rating ";
$ratingInsert = $db->insertNewRating(90, "This is another comment",5,"RIT", 1);

echo "<pre>";
print_r($ratingInsert);
echo "</pre>";

echo "=========================================";
echo "\Get Recent Ratings";

$beerRatings = $db->getRecentRatings();

echo "<pre>";
print_r($beerRatings);
echo "</pre>";

