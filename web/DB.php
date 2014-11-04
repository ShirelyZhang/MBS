<?php
require_once('db_config.php');

class DB {

	public static function getConn() {
		$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;

		try {
			$conn = new PDO($dsn, DB_USER, DB_PWD);
		} catch (PDOException $e) {
			die('Connect failed: ' . $e->getMessage());
		}

		return $conn;
	}
}