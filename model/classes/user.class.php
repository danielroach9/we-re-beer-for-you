<?php

/**
 *
 */
class User
{
  private $uuid, $first_name, $last_name, $password, $email, $role;

  	// Get the User's id in the system
	public function getID(){return $this->uuid;}
	// Get the User's first name
	public function getFirstName(){return $this->first_name;}
	// Get the User's last name
	public function getLastName(){return $this->last_name;}
	// Get the User's whole name
	public function getWholeName(){return $this->first_name." ".$this->last_name;}
	// Get the User's email
	public function getEmail(){return $this->email;}
	// Get the User's password
	public function getPassword(){return $this->password;}
	// Get the User's current role in the system
	public function getRole(){return $this->role;}
}
