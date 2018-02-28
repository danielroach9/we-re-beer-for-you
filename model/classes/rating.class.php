<?php

/**
 *
 */
class Rating
{
  private $uuid, $location, $rating, $comments, $beerID, $purchase_id;

  	// Get the User's id in the system
	public function getID(){return $this->uuid;}
	// Get the Rating's location
	public function getLocation(){return $this->location;}
	// Get the Rating's rating number
	public function getRating(){return $this->rating;}
	// Get the Rating's comments
	public function getComments(){return $this->comments;}
	// Get the Rating's beer ID
	public function getBeerID(){return $this->beerID;}
	// Get the Rating's purchase ID
	public function getPurchaseID(){return $this->purchase_id;}

}
