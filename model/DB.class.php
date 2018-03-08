<?php
session_start();
if(isset($_POST['action'])){
	$action = $_POST['action'];
	$db = new DB();

	switch ($action){
		case 'performLogin':
			$user = isset($_POST['user']) ? $_POST['user'] : null;
			$pass = isset($_POST['pass']) ? $_POST['pass'] : null;
			$value = $db->performLogin($user, $pass);
			return $value;
			break;
		case 'getStylesByCategory':
			$cat_id = isset($_POST['category']) ? $_POST['category'] : null;
			$value = $db->getStylesByCategory($cat_id);
			echo json_encode($value);
			//print_r($value);
			//return $value; //why does print_r do what return should???
			break;
		case 'insertNewPreference':
			$uuid = isset($_POST['uuid']) ? $_POST['uuid'] : null;
			$abv = isset($_POST['abv']) ? $_POST['abv'] : null;
			$category = isset($_POST['category']) ? $_POST['category'] : null;
			$style = isset($_POST['style']) ? $_POST['style'] : null;
			$country = isset($_POST['country']) ? $_POST['country'] : null;
			$value = $db->insertNewPreference($uuid, $abv, $category, $style, $country);
			echo $value;
			break;
		case 'getPreferredBeer':
			$uuid = isset($_POST['uuid']) ? $_POST['uuid'] : null;
			$abv = isset($_POST['abv']) ? $_POST['abv'] : null;
			$category = isset($_POST['category']) ? $_POST['category'] : null;
			$style = isset($_POST['style']) ? $_POST['style'] : null;
			$country = isset($_POST['country']) ? $_POST['country'] : null;
			$value = $db->getPreferredBeer($uuid, $abv, $category, $style, $country);
			echo $value;
		break;

			# code...
			break;
	}
}
class DB{

	function __construct(){
		require_once("classes/user.class.php");
		require_once("classes/message.class.php");
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

	function performLogin($_email,$_pass){
		$user = $this->getUserByEmail($_email);

		if($user){
			if(password_verify($_pass, $user[0]->getPassword())){
				$_SESSION['loggedIn'] = true;
				$_SESSION['accountID'] = $user[0]->getID();
				$_SESSION['accountFirstName'] = $user[0]->getFirstName();
				$_SESSION['accountLastName'] = $user[0]->getLastName();
				$_SESSION['accountEmail'] = $user[0]->getEmail();
				echo "true";
				return true;
			}
		}
		echo "false";
		return false;
	}

	function performLogOut(){
		session_unset();
		session_destroy();
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

	function getUserByEmail($_email){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM user
										WHERE email = :email");
			$stmt->bindParam(":email",$_email,PDO::PARAM_STR);
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

	/**
	 * 	insertNewRating - will insert a new record to the user table with the
	 * provided information.
	 *
	 * @param string $_beerID - firstName of the user to add.
	 * @param string $_comment - lastName of the user to add.
	 * @param integer $_rating - roleid of the user to add.
	 * @param string $_location - email of the user to add.
	 * @param string $_uuid - pasword of the user to add.
	 * @return integer containing the id of the newest user added.
	 **/
	function insertNewRating($_beerID,$_comment,$_rating, $_location, $_uuid){

		try{
			$stmt = $this->db->prepare("INSERT INTO rating
								(beer_id, comment, rating, location, uuid)
				VALUES (:beerID,:comment,:rating,:location,:uuid)");
			$stmt->bindParam(":beerID",$_beerID,PDO::PARAM_INT);
			$stmt->bindParam(":comment",$_comment,PDO::PARAM_STR);
			$stmt->bindParam(":rating",$_rating,PDO::PARAM_INT);
			$stmt->bindParam(":location",$_location,PDO::PARAM_STR);
			$stmt->bindParam(":uuid",$_uuid,PDO::PARAM_INT);
			$stmt->execute();

			return $this->db->lastInsertId();
		}
		catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
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
			$stmt = $this->db->prepare("SELECT DISTINCT country FROM breweries");
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $data;
		}
		catch(PDOException $e){
			echo "getCountries - ".$e->getMessage();
			die();
		}

			return $data;
	}

	function getStylesByCategory($cat_id){ // sanitize var, check if int
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT id, style_name
																	FROM styles
																	WHERE cat_id = ".$cat_id);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC); // does this need to change as per above when selecting multiple

			return $data;
		}
		catch(PDOException $e){
			echo "getStylesByCategory - ".$e->getMessage();
			die();
		}

		return false;
	}

	function insertNewPreference($_uuid,$_abv,$_category,$_style, $_country){

		try{
			$stmt = $this->db->prepare("INSERT INTO preferences
								(uuid, preferred_abv_range, preferred_category, preferred_style, preferred_country)
				VALUES (:uuid,:abv,:category,:style, :country)");
			$stmt->bindParam(":uuid",$_uuid,PDO::PARAM_INT);
			$stmt->bindParam(":abv",$_abv,PDO::PARAM_INT);
			$stmt->bindParam(":category",$_category,PDO::PARAM_INT);
			$stmt->bindParam(":style",$_style,PDO::PARAM_INT);
			$stmt->bindParam(":country",$_country,PDO::PARAM_STR);//country name
			$stmt->execute();

			return $this->db->lastInsertId();
			// return "test boi";
		}
		catch(PDOException $e){
			echo $e->getMessage();
			die();
		}
	}

	function getPreferredBeer($_uuid,$_abv,$_category,$_style, $_country){ // give uuid, get curated beers
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT b.id, b.name, c.cat_name, s.style_name
																	FROM beers b
																	JOIN breweries br on br.id = b.brewery_id
																	JOIN categories c on c.id = b.cat_id
																	JOIN styles s on s.id = b.style_id
																	WHERE b.cat_id = ".$_category.
																	" AND b.style_id = ".$_style.
																	" AND br.country = '".$_country."'");


			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC); // does this need to change as per above when selecting multiple

			return $data;
		}
		catch(PDOException $e){
			echo "getStylesByCategory - ".$e->getMessage();
			die();
		}

		return false;
	}


//============================================================

	function getAllMessages(){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM message");
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_CLASS,'message');

			return $data;
		}
		catch(PDOException $e){
			echo "getAllMessages - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getMessageByID($_message_id){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM message
										WHERE message_id = :message_id");
			$stmt->bindParam(":message_id",$_message_id,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_CLASS,'message');

			return $data;
		}
		catch(PDOException $e){
			echo "getMessageByID - ".$e->getMessage();
			die();
		}
		return $data;
	}

	function getMessagesForUser($_uuid){
		try{
			$data = array();
			$stmt = $this->db->prepare("SELECT * FROM message
										WHERE recipient_uuid = :uuid");
			$stmt->bindParam(":uuid",$_uuid,PDO::PARAM_INT);
			$stmt->execute();

			$data = $stmt->fetchAll(PDO::FETCH_CLASS,'message');

			return $data;
		}
		catch(PDOException $e){
			echo "getMessagesForUser - ".$e->getMessage();
			die();
		}
		return $data;
	}

	/**
	 * 	insertNewMessage - will insert a new record to the message table with the
	 * provided information.
	 *
	 * @param string $_recipientUUID - uuid of the user who is the message recipient.
	 * @param string $_senderUUID - uuid of the user who is sending the message.
	 * @param integer $_title - title of the message to send.
	 * @param string $_content - content of the message to send.
	 * @return integer containing the id of the newest user added.
	 **/
	function insertNewMessage($_recipientUUID, $_senderUUID,$_title,$_content){
		try{
			$stmt = $this->db->prepare("INSERT INTO message
								(recipient_uuid,sender_uuid,title,content)
				VALUES (:recipient_uuid,:sender_uuid,:title,:content)");
			$stmt->bindParam(":recipient_uuid",$_recipientUUID,PDO::PARAM_INT);
			$stmt->bindParam(":sender_uuid",$_senderUUID,PDO::PARAM_INT);
			$stmt->bindParam(":title",$_title,PDO::PARAM_STR);
			$stmt->bindParam(":content",$_content,PDO::PARAM_STR);
			$stmt->execute();

			return $this->db->lastInsertId();
		}
		catch(PDOException $e){
			echo "insertNewMessage - ".$e->getMessage();
			die();
		}
	}

}
