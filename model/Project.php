<?php

class Project {
	public $projectId;
	public $projectName;
	public $customer;
	public $contact;
	public $deadline;
	public $estimatedHours;
	public $priceHour;
	public $priceTot;
	public $participants;
	public $github;
	public $description;
	public $approved;
	public $started;
	public $finished;
	public $delivered;
	public $billed;
	
	function __construct($projectId, $projectName, $customer, $contact) {
		$this->projectId = $projectId;
		$this->projectName = $projectName;
		$this->customer = $customer;
		$this->contact = $contact;
	}
	
	public static function deletFromDb($projectId, $link) {
		$query = "DELETE FROM projects
				WHERE projectId LIKE ?";
		
		if (!($stmt = $link->prepare($query))) return false;
		
		if (!$stmt->bind_param("i", $projectId)) return false;
		
		if (!$stmt->execute()) return false;
		
		$stmt->close();
		
		return true;
	}
	
	public static function getProjects($link) {
		$query = "SELECT * FROM projects
				ORDER BY deadline ASC";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->execute()) return null;
		
		if (!$result = $stmt->get_result()) return null;
		
		$cars = self::getRows($result);
		
		$stmt->close();
		
		return $cars;
	}
	
	public static function getProjectById($projectId, $link) {
		$query = "SELECT * FROM projects
				WHERE projectId LIKE ?
				ORDER BY deadline DESC";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->bind_param("i", $projectId)) {
			return null;
		}
		
		if (!$stmt->execute()) return null;
		
		if (!$result = $stmt->get_result()) return null;
		
		$projects = self::getRows($result);
		
		$stmt->close();
		
		return $projects[0];
	}
	
	private static function getRows($result) {
		$projects = null;
		while ($row = $result->fetch_array()) {
			$project = new Project($row['projectId'], $row['projectName'], $row['customer'], $row['contact']);
			
			$project->deadline = $row['deadline'];
			$project->estimatedHours = $row['estimatedHours'];
			$project->priceHour = $row['priceHour'];
			$project->priceTot = $row['priceTot'];
			$project->participants = $row['participants'];
			$project->github = $row['github'];
			$project->description = $row['description'];
			$project->approved = $row['approved'];
			$project->started = $row['started'];
			$project->finished = $row['finished'];
			$project->delivered = $row['delivered'];
			$project->billed = $row['billed'];
			
			$projects[] = $project;
		}
		
		return $projects;
	}
	
	public function addToDb($link) {
		
		$query = "INSERT INTO projects (
					projectId,
					projectName,
					customer,
					contact,
					deadline,
					estimatedHours,
					priceHour,
					priceTot,
					participants,
					github,
					description,
					approved,
					started,
					finished,
					delivered,
					billed
				)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				
				ON DUPLICATE KEY UPDATE
					projectName = VALUES (projectName),
					customer = VALUES (customer),
					contact = VALUES (contact),
					deadline = VALUES (deadline),
					estimatedHours = VALUES (estimatedHours),
					priceHour = VALUES (priceHour),
					priceTot = VALUES (priceTot),
					participants = VALUES (participants),
					description = VALUES (description),
					approved = VALUES (approved),
					started = VALUES (started),
					finished = VALUES (finished),
					delivered = VALUES (delivered),
					billed = VALUES (billed)";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->bind_param("isssissssssiiiii",
				$this->projectId,
				$this->projectName,
				$this->customer,
				$this->contact,
				$this->deadline,
				$this->estimatedHours,
				$this->priceHour,
				$this->priceTot,
				$this->participants,
				$this->github,
				$this->description,
				$this->approved,
				$this->started,
				$this->finished,
				$this->delivered,
				$this->billed)) {
			return null;
		}
		
		if (!$stmt->execute()) return null;
		
		if (!$stmt->insert_id) {
			$query = "SELECT * FROM projects WHERE projectId LIKE ?";
				
			if (!($stmt = $link->prepare($query))) return null;
				
			if (!$stmt->bind_param("i", $this->projectId)) return null;
				
			if (!$stmt->execute()) return null;
				
			if (!$result = $stmt->get_result()) return null;
				
			if (!$row = $result->fetch_array()) return null;
				
			$this->projectId = $row['projectId'];
		} else {
			$this->projectId = $stmt->insert_id;
		}
		
		$stmt->close();
	}
}

?>
