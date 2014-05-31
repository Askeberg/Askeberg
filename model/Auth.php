<?php

class Auth {
	public $fromLoc;
	public $toLoc;
	public $key;
	public $validated = false;
	
	function __construct($fromLoc, $toLoc, $key, $link) {
		$this->fromLoc = $fromLoc;
		$this->toLoc = $toLoc;
		$this->key = md5($key);
	}
	
	public function setValidated($link) {
		$query = "SELECT * FROM authKey";
		
		if (!($stmt = $link->prepare($query))) return null;
		
		if (!$stmt->execute()) return null;
		
		if (!$result = $stmt->get_result()) return null;
		
		if (!$row = $result->fetch_array()) return null;
		
		if ($row['key_'] == $this->key) $this->validated = true;
		
		$stmt->close();
	}
	
	public function authenticate() {
		if ($this->validated) {
			$_SESSION['auth'] = true;
			header('Location: ' . $this->toLoc);
			return true;
		}
		else {
			$_SESSION['auth'] = false;
			$_SESSION['info'][] = 'Autentisering feilet';
			header('Location: ' . $this->fromLoc);
			return false;
		}
	}
}

?>
