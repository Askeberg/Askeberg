<?php

class wage {
	public $wageId;
	public $projectId;
	public $person;
	public $date;
	public $hours;
	public $description;
	
	function __construct($wageId, $projectId, $person, $date, $hours, $description) {
		$this->wageId = $wageId;
		$this->projectId = $projectId;
		$this->person = $person;
		$this->date = $date;
		$this->hours = $hours;
		$this->description = $description;
	}
	
	public static function deletFromDb($wageId, $link) {
		$query = "DELETE FROM wages
				WHERE wageId LIKE ?";
		
		if (!($stmt = $link->prepare($query))) return false;
		
		if (!$stmt->bind_param("i", $wageId)) return false;
		
		if (!$stmt->execute()) return false;
		
		$stmt->close();
		
		return true;
	}
	
	public static function getWagesByProjectId($projectId, $link) {
		$query = "SELECT * FROM wages
				WHERE projectId LIKE ?
				ORDER BY date";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->bind_param("i", $projectId)) {
			return null;
		}
		
		if (!$stmt->execute()) return null;
		
		if (!$result = $stmt->get_result()) return null;
		
		$wages = self::getRows($result);
		
		$stmt->close();
		
		return $wages;
	}
	
	public static function getWagesByDate($fromDate, $toDate, $link) {
		$query = "SELECT * FROM wages
				WHERE date BETWEEN ? AND ?
				ORDER BY date";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->bind_param("ii",
				$fromDate,
				$toDate)) {
			return null;
		}
		
		if (!$stmt->execute()) return null;
		
		if (!$result = $stmt->get_result()) return null;
		
		$wages = self::getRows($result);
		
		$stmt->close();
		
		return $wages;
	}
	
	private static function getRows($result) {
		$wages = null;
		while ($row = $result->fetch_array()) {
			$wage = new Wage($row['wageId'], $row['projectId'], $row['person'],
							$row['date'], $row['hours'], $row['description']);
			
			$wages[] = $wage;
		}
		
		return $wages;
	}
	
	public function addToDb($link) {
		$query = "INSERT INTO wages (
					wageId,
					projectId,
					person,
					date,
					hours,
					description
				)
				VALUES (?, ?, ?, ?, ?, ?)
				
				ON DUPLICATE KEY UPDATE
					date = VALUES (date),
					hours = VALUES (hours),
					description = VALUES (description)";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->bind_param("iisids",
				$this->wageId,
				$this->projectId,
				$this->person,
				$this->date,
				$this->hours,
				$this->description)) {
			return null;
		}
		
		if (!$stmt->execute()) return null;
		
		if (!$stmt->insert_id) {
			$query = "SELECT * FROM wages WHERE wageId LIKE ?";
				
			if (!($stmt = $link->prepare($query))) return null;
				
			if (!$stmt->bind_param("i", $this->wageId)) return null;
				
			if (!$stmt->execute()) return null;
				
			if (!$result = $stmt->get_result()) return null;
				
			if (!$row = $result->fetch_array()) return null;
				
			$this->wageId = $row['wageId'];
		} else {
			$this->wageId = $stmt->insert_id;
		}
		
		$stmt->close();
	}
}

?>
