<?php

class DB 
{
	
	function __construct()
	{
		require_once("dbInfo.php");

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

			$data = $stmt->fetch(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getAllUsers - ".$e->getMessage();
			die();
		}
		return $data;
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
			echo "getAllBeers - ".$e->getMessage();
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
										JOIN breweries bs ON bs.id = b.brewery_id;
										where b.id = :id");
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
			$stmt = $this->db->prepare("SELECT b.name, c.cat_name, s.style_name, b.abv, b.descript
										FROM beers b
										JOIN categories c ON c.id = b.cat_id
										JOIN styles s ON s.id = b.style_id
										WHERE b.name LIKE :name");
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getAllBeers - ".$e->getMessage();
			die();
		}
		return $data;
	}
}