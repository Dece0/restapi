<?php

class DB {
	private $pdo = null;

	private function __construct() {
		$path = __DIR__ . "/database";
		$file = "database.sqlite";
		$this->pdo = new PDO("sqlite:{$path}/{$file}");
	}

	public static function getInstance() {
		static $instance = null;
		if($instance == null) $instance = new DB();
		return $instance;
	}
	
	public function getTableList(): array {
		$sql = "SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getAllMeasurements() {
		$sql = "SELECT * FROM measurements";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);;
	}
	
	public function getMeasurementsByQuantityName(string $quantityName) {
		$sql = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.quantity_name = :quantityName
		ORDER BY m.time ASC";
		$queryHandler = $this->pdo->prepare($sql);
		return ($queryHandler->execute([ 'quantityName' => $quantityName ])) ? $queryHandler->fetchAll( PDO::FETCH_ASSOC ) : [];
	}
	
	public function test(string $quantityName) {
		$sql = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.quantity_name = :quantityName
		ORDER BY m.time ASC";
		$queryHandler = $this->pdo->prepare($sql);
		return ($queryHandler->execute([ 'quantityName' => ucfirst($quantityName) ])) ? $queryHandler->fetchAll( PDO::FETCH_ASSOC ) : [];
	} 
}
