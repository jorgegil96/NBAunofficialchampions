<?php
class Team {
	private $id;
	private $name;
	private $otherNames = [];

	public function __construct($id) {
		$this->id = $id;
	}

	public function getId() {
		return $id;
	}

	
}
?>