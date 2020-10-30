<?php

class roomsReportsModel extends model{
	public function __construct(){
		$this->connect();
	}

	public function inRooms($data){

		try{
			$stmt = $this->DB->prepare("SELECT reference,room_id FROM rooms_availability WHERE busy_from <= ? AND busy_to >= ?");
			$stmt->execute(array($data[1],$data[2]));
			$IDs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $this->getRoomsAndClients($data[0],$IDs);

		}catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
	        echo json_encode($error);
	        die();
	    }
	}

	public function getRoomsAndClients($hotel,$IDs){
		try{
			$result = array();
			foreach ($IDs as $id) {
				$client = array();
				$room = array();
				if(!$this->roomIsInHotel($hotel,$id['room_id'])){
					break;
				}
				$stmt = $this->DB->prepare("SELECT * FROM rooms WHERE  room_id= ?");
				$stmt->execute(array($id['room_id']));
				$room = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt1 = $this->DB->prepare("SELECT * FROM rooms_clients WHERE  client_id= ?");
				$stmt1->execute(array($id['reference']));
				$client = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				array_push($result, array_merge($client,$room));
				
			}
			return $result;

		}catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
	        echo json_encode($error);
	        die();
	    }

	}

	public function roomIsInHotel($hotel,$room){
		try{
			$stmt = $this->DB->prepare("SELECT COUNT(*) AS counter FROM rooms JOIN rooms_categories ON rooms.room_category = rooms_categories.category_id WHERE rooms.room_id = ? AND rooms_categories.hotel = ?");
			$stmt->execute(array($room,$hotel));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result[0]['counter'];
		}catch (PDOException $e) {
			$error = array('ERRORss' => $e->getMessage());
	        echo json_encode($error);
	        die();
	    }
	}

	public function roomsByHotel($data){
		$hotel = $data[0];
		$rooms = array();
		foreach ($data[1] as $id) {
			if(!$this->roomIsInHotel($hotel,$id)){
				break;
			}
			$stmt = $this->DB->prepare("SELECT * FROM rooms WHERE  room_id= ?");
			$stmt->execute(array($id));
			$room = $stmt->fetchAll(PDO::FETCH_ASSOC);
			array_push($rooms, $room);
		}

		return $rooms;
	}
}
