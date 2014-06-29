<?php

class Db {
	private static $host = '127.0.0.1';
	private static $user = 'root';
	private static $pass = '';
	private static $db = 'askeberg';
	private static $port = '3306';
	
	public static function connect() {
		$link = new mysqli(self::$host, self::$user, self::$pass, null, self::$port);
		
		if ($link->connect_errno) {
			$_SESSION['error'][] = '<h3>MySQL feil: (' . $link->connect_errno . ') ' .
					$link->connect_error . ' --> class SqlConnect, connect(), if ($link)</h3>';
			
			return false;
		}
		else {
			$link->query("CREATE DATABASE IF NOT EXISTS " . self::$db);
			$link->select_db(self::$db);
			$link->set_charset('utf8');
			
			return $link;
		}
	}
}

class Table {
	
	public static function createTables($link) {
		
		$authKey = "CREATE TABLE IF NOT EXISTS authKey (
					key_ VARCHAR(255) NOT NULL
				)";
		
		$wages = "CREATE TABLE IF NOT EXISTS wages (
					wageId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					projectId INT NOT NULL,
					person VARCHAR(255) NOT NULL,
					start BIGINT NOT NULL DEFAULT 0,
					end BIGINT NOT NULL DEFAULT 0,
					description VARCHAR(255) NOT NULL
				)";
		
		$projects = "CREATE TABLE IF NOT EXISTS projects (
					projectId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					projectName VARCHAR(255) NOT NULL,
					customer VARCHAR(255) NOT NULL,
					contact VARCHAR(255) NOT NULL,
					deadline BIGINT NOT NULL DEFAULT 0,
					estimatedHours VARCHAR(255) NOT NULL,
					priceHour VARCHAR(255) NOT NULL,
					priceTot VARCHAR(255) NOT NULL,
					participants VARCHAR(255) NOT NULL,
					github VARCHAR(255) NOT NULL,
					description TEXT NOT NULL,
					approved BOOLEAN NOT NULL DEFAULT FALSE,
					started BOOLEAN NOT NULL DEFAULT FALSE,
					finished BOOLEAN NOT NULL DEFAULT FALSE,
					delivered BOOLEAN NOT NULL DEFAULT FALSE,
					billed BOOLEAN NOT NULL DEFAULT FALSE
				)";
		
		$link->query($authKey);
		$link->query($wages);
		$link->query($projects);
	}
}

?>
