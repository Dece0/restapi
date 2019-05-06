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
	
	public function getAllMeasurements(): array {
		$sql = "SELECT * FROM measurements ORDER BY time ASC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function getMeasurementsByQuantityName(string $quantityName): array {
		$sql = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.quantity_name = :quantityName
		ORDER BY m.time ASC";
		$queryHandler = $this->pdo->prepare($sql);
		return ($queryHandler->execute([ 'quantityName' => $quantityName ])) ? $queryHandler->fetchAll( PDO::FETCH_ASSOC ) : [];
	}

	public function getLastMeasurements() {
		$sql1 = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.physical_quantity_id = 1
		ORDER BY m.time DESC
		LIMIT 1";

		$sql2 = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.physical_quantity_id = 2
		ORDER BY m.time DESC
		LIMIT 1";

		$sql3 = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.physical_quantity_id = 3
		ORDER BY m.time DESC
		LIMIT 1";


		$sql4 = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.physical_quantity_id = 4
		ORDER BY m.time DESC
		LIMIT 1";


		$sql5 = "SELECT m.value, m.time, p.quantity_name, p.unit_symbol 
		FROM measurements AS m
		LEFT JOIN physical_quantities AS p ON m.physical_quantity_id = p.physical_quantity_id
		WHERE p.physical_quantity_id = 5
		ORDER BY m.time DESC
		LIMIT 1";

		return [
			$this->pdo->query($sql1)->fetch(PDO::FETCH_ASSOC),
			$this->pdo->query($sql2)->fetch(PDO::FETCH_ASSOC),
			$this->pdo->query($sql3)->fetch(PDO::FETCH_ASSOC),
			$this->pdo->query($sql4)->fetch(PDO::FETCH_ASSOC),
			$this->pdo->query($sql5)->fetch(PDO::FETCH_ASSOC),

		];
	}

	public function getAllQuantities(): array {
		$sql = "SELECT * FROM physical_quantities";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllStationAttributes(): array {
		$sql = "SELECT name, latitude, longitude FROM weather_stations";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getCoords(): array {
		$sql = "SELECT latitude, longitude FROM weather_stations";
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
	}

	public function getStationName(): array {
		$sql = "SELECT name FROM weather_stations";
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
	}

	public function getAllSettings() {
		$sql = "SELECT * FROM configurations";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	} 

	public function saveStationName($stationName): bool {
		$sql = "UPDATE weather_stations SET name = :name WHERE weather_station_id = 1";
		$queryHandler = $this->pdo->prepare($sql);
		$queryHandler->execute([ 'name' => $stationName ]);
		return $queryHandler->rowCount() ? true : false;
	}

	public function saveSettings($settings) {
		foreach ($settings as $item) {
			$sql = "UPDATE configurations SET value = :value WHERE type = :type";
			$queryHandler = $this->pdo->prepare($sql);
			$queryHandler->execute([ 
				'value' => $item['value'],
				'type' => $item['type']
			]);
		}
	}
	
	public function test() {
		$sql = "SELECT * FROM configurations";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
	} 
}
