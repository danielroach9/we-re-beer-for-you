<?php

class DB
{

	function __construct()
	{
		require_once("classes/user.class.php");
		require_once("classes/rating.class.php");

		require("dbInfo.php");

		try{
			$this->db = new PDO("mysql:host=$host;dbname=$db",$user,$pass);

			//change error reporting
			$this->db->setAttribute(PDO::ATTR_ERRMODE,
									  PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
	}

	function getAllUsers(){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM user");
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_CLASS,'user');

			return $data;
		}
		catch(PDOException $e){
			echo "getAllUsers - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getUserByID($_uuid){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM user
										WHERE uuid = :uuid");
			$stmt->bindParam(":uuid",$_uuid,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_CLASS,'user');

			return $data;
		}
		catch(PDOException $e){
			echo "getUserByID - ".$e->getMessage();
			die();
		}
		return $data;
	}

	/**
	 * 	insertNewUser - will insert a new record to the user table with the
	 * provided information.
	 *
	 * @param string $_firstName - firstName of the user to add.
	 * @param string $_lastName - lastName of the user to add.
	 * @param integer $_roleID - roleid of the user to add.
	 * @param string $_email - email of the user to add.
	 * @param string $_password - pasword of the user to add.
	 * @return integer containing the id of the newest user added.
	 **/
	function insertNewUser($_firstName, $_lastName,$_email,$_password, $_roleID){
		$password = password_hash($_password, PASSWORD_DEFAULT);
		try{
			$stmt = $this->db->prepare("INSERT INTO user
								(first_name,last_name,email,password,role)
				VALUES (:first_name,:last_name,:email,:password,:role)");
			$stmt->bindParam(":first_name",$_firstName,PDO::PARAM_STR);
			$stmt->bindParam(":last_name",$_lastName,PDO::PARAM_STR);
			$stmt->bindParam(":email",$_email,PDO::PARAM_STR);
			$stmt->bindParam(":password",$password,PDO::PARAM_STR);
			$stmt->bindParam(":role",$_roleID,PDO::PARAM_INT);
			$stmt->execute();

			return $this->db->lastInsertId();
		}
		catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
	}

	function getAllBeers(){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM beers");
			$stmt->execute();

			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getAllBeers - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getBeerByID($_id){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM beers where id = :id");
			$stmt->bindParam(":id",$_id,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getBeerByID - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getBeerInfoByID($_id){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT b.name, bs.name AS 'brewery_name', c.cat_name, s.style_name, b.abv, b.descript
										FROM beers b
										JOIN categories c on c.id = b.cat_id
										JOIN styles s on s.id = b.style_id
										JOIN breweries bs ON bs.id = b.brewery_id
										WHERE b.id = :id");
			$stmt->bindParam(":id",$_id,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getAllBeers - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getBeerInfoByName($_name){
		try{
			$data = array();
			$name = "%".$_name."%";
			$stmt = $this->db->prepare("SELECT b.name, c.cat_name,
			 s.style_name, b.abv, b.descript
										FROM beers b
										JOIN categories c ON c.id = b.cat_id
										JOIN styles s ON s.id = b.style_id
										WHERE b.name LIKE :name
										AND b.descript NOT LIKE ''");
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getBeerInfoByName - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getBeersByBrewery($_id){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT b.id, b.name, c.cat_name, s.style_name
										FROM beers b
										JOIN categories c on c.id = b.cat_id
										JOIN styles s on s.id = b.style_id
										WHERE b.brewery_id = :id");
			$stmt->bindParam(":id",$_id,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getBeersByBrewery - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getBreweryInfoByID($_id){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT name, address1, address2, city, state, code, country, phone, website, descript
										FROM breweries
										WHERE id = :id");
			$stmt->bindParam(":id",$_id,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getBreweryInfoByID - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getRecentRatings(){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM rating
							ORDER BY purchase_id DESC
							LIMIT 5 ");
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_CLASS,'rating');

			return $data;
		}
		catch(PDOException $e){
			echo "getRecentRatings - ".$e->getMessage();
			die();
		}
		return $data;
	}
	function getCategories(){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT id, cat_name FROM categories");
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getCategories - ".$e->getMessage();
			die();
		}
		return $data;
	}
	function getCountries(){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT country FROM breweries");
			$stmt->execute();

			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getCountries - ".$e->getMessage();
			die();
		}

			return $data;
		}

}
