<?php

class roomsModel extends model{
	public function __construct(){
		$this->connect();
	}

	public function exists($cat){
		try {
				$stmt=$this->DB->prepare("SELECT * FROM rooms_categories WHERE category_id=? AND hotel=?");
				$stmt->execute($cat);
				$nbr=$stmt->rowCount();
				return $nbr;
		} catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}
	}

	public function addroom($data){
		try {
			$roomnumber=$this->getroomnumber($data);
			$id=$this->getId('rooms','room_id');
			$stmt=$this->DB->prepare("INSERT INTO rooms(room_id,room_No,prefix,room_category) VALUES(?,?,?,?)");
			$stmt->execute(array($id,$roomnumber,$_POST['prefix'],$_POST['category']));

		} catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}
		
	}

	public function addClient($clientData){
		try{
			$id = $this->getId('rooms_clients','client_id');
			array_unshift($clientData, $id);
			$stmt = $this->DB->prepare("INSERT INTO rooms_clients(client_id,client_name,client_nationality,client_passport_id,client_age,client_gender,client_address) values(?,?,?,?,?,?,?)");

			$stmt->execute($clientData);
			return $id;
		} catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}
	}

	public function roomsNeverTaken($data){
		try{
			$stmt2 = $this->DB->prepare("SELECT room_id FROM rooms_availability");
			$stmt2 ->execute();
			$rooms_ever_taken = $stmt2->fetchAll(PDO::FETCH_ASSOC);
			$rooms_ever_takenArray= array();
			foreach ($rooms_ever_taken as $room) {
				array_push($rooms_ever_takenArray,$room['room_id']);
			}

			//first index of data array to specify if its going to retreive for all categories or not

			if($data[0]==0){
				$stmt3 = $this->DB->prepare("SELECT rooms.room_id FROM rooms JOIN rooms_categories ON rooms.room_category=rooms_categories.category_id WHERE rooms.room_category=? ");
				$stmt3 ->execute(array($data[1]));
			}else{
				$stmt3 = $this->DB->prepare("SELECT room_id FROM rooms");
				$stmt3 ->execute();
			}
			
			$all_rooms = $stmt3->fetchAll(PDO::FETCH_ASSOC);
			$all_roomsArray= array();
			foreach ($all_rooms as $room) {
				array_push($all_roomsArray,$room['room_id']);
			}

			$rooms_never_takenArray = array_diff($all_roomsArray, $rooms_ever_takenArray);
			return $rooms_never_takenArray;

		} catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}
	}

	public function availableRooms($data){
		try{

			//first index of data array to specify if its going to retreive for all categories or not

			$check = array_shift($data);
			if($check == 0){
				#to query rooms which are busy or taken on the specified date
				$stmt = $this->DB->prepare("SELECT rooms_availability.room_id FROM rooms_availability JOIN rooms ON rooms_availability.room_id = rooms.room_id WHERE room_category =? AND (rooms_availability.availability_status = 1 AND (rooms_availability.busy_from <= ? AND rooms_availability.busy_to >= ?))");
			}else{
				#to query rooms which are busy or taken on the specified date
				$stmt = $this->DB->prepare("SELECT rooms_availability.room_id FROM rooms_availability JOIN rooms ON rooms_availability.room_id = rooms.room_id WHERE (rooms_availability.availability_status = 1 AND (rooms_availability.busy_from <= ? AND rooms_availability.busy_to >= ?))");
			}

			$stmt->execute($data);
			$rooms_unavailable = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$rooms_unavailableArray = array();
			foreach ($rooms_unavailable as $room) {
				array_push($rooms_unavailableArray,$room['room_id']);
			}
			if($check==0){
				#if category is given limit the results on the specified category
				$stmt3 = $this->DB->prepare("SELECT rooms.room_id FROM rooms JOIN rooms_categories ON rooms.room_category=rooms_categories.category_id WHERE rooms.room_category=? ");
				$stmt3 ->execute(array($data[0]));
			}else{
				$stmt3 = $this->DB->prepare("SELECT room_id FROM rooms ");
				$stmt3 ->execute();
			}
			$all_rooms = $stmt3->fetchAll(PDO::FETCH_ASSOC);
			$all_roomsArray= array();
			foreach ($all_rooms as $room) {
				array_push($all_roomsArray,$room['room_id']);
			}
			$rooms_available = array_diff($all_roomsArray, $rooms_unavailableArray);
			return $rooms_available;

		} catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}

	}

	public function getRoom($rooms){
		$lowest_frequency=1000000000000;
		$roomId = 0;
		foreach ($rooms as $room) {
			$stmt = $this->DB->prepare(" SELECT COUNT(*) AS frequency FROM rooms_availability WHERE room_id = ?");
			$stmt->execute(array($room));
			$frequency = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['frequency'];
			$lowest_frequency = $frequency <= $lowest_frequency? $frequency :$lowest_frequency;
			$roomId = $frequency <= $lowest_frequency? $room :$roomId;
		}
		return $roomId;
	}

	public function grantRoom($data){
		try{
			$id = $this->getId('rooms_availability','rooms_availability_id');
			array_unshift($data,$id);
			$stmt = $this->DB->prepare("INSERT INTO rooms_availability(rooms_availability_id,room_id,busy_from,busy_to,reference) values(?,?,?,?,?)");
			$stmt->execute($data);
			$stmt1 = $this->DB->prepare("SELECT * FROM rooms JOIN rooms_categories ON room_category=category_id WHERE room_id = ?");
			$stmt1->execute(array($data[1]));
			return $stmt1->fetchAll(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}
	}
	
	public function checkOut($client){
		try{
			$stmt = $this->DB->prepare("UPDATE rooms_availability SET availability_status = 0 WHERE rooms_availability.reference = ?");
			$stmt->execute(array($client));
			return $stmt->rowCount();
			
		}catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
            echo json_encode($error);
            die();
		}

	}
}






?>