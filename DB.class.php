<?php
session_start();

/**
* 
*/
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
}