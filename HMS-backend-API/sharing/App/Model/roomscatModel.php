<?php

class roomscatModel extends model{
	public function __construct(){
		$this->connect();
	}

	public function addroomcat($cat){
		try {
			$id = $this->getId('rooms_categories', 'category_id');
			array_unshift($cat,$id);
			$stmt=$this->DB->prepare("INSERT INTO rooms_categories(category_id,category_name,price,hotel) VALUES(?,?,?,?)");
			$stmt->execute($cat);
			return $id;
		} catch (PDOException $th) {
			$error = array('ERRORss' => $th->getMessage());
            echo json_encode($error);
            die();
		}
	}

	public function categoriesAvailable($data){
		$rooms = $data[1];
		$hotel = $data[0];
		$categories = array();
		foreach ($rooms as $room) {
			$sql_query = "SELECT rooms_categories.category_id FROM rooms JOIN rooms_categories ON rooms.room_category= rooms_categories.category_id WHERE rooms.room_id=? AND rooms_categories.hotel = ?";
			$stmt = $this->DB->prepare($sql_query);
			$stmt->execute(array($room,$hotel));
			$categ = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach ($categ as $category) {
				array_push($categories, $category['category_id']);
			}
		}

		//remove repetitions
		$categories = array_unique($categories);

		$result = array();
		foreach ($categories as $categId) {
			$stmt1 = $this->DB->prepare("SELECT * FROM rooms_categories WHERE category_id = ?");
			$stmt1->execute(array($categId));
			$category = $stmt1->fetchAll(PDO::FETCH_ASSOC);
			array_push($result, $category);
		}
		return $result;
		
	}

}






?>