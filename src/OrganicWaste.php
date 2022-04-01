<?php
require_once "Waste.php";

class OrganicWaste extends Waste
{
	private $compostEmissions;

	// public function __construct() {
	// 	Waste::$instances[] = $this;
	// }

	/**
	 * Get the value of compostEmissions
	 */ 
	public function getCompostEmissions()
	{
		return $this->compostEmissions;
	}

	/**
	 * Set the value of compostEmissions
	 *
	 * @return  self
	 */ 
	public function setCompostEmissions($compostEmissions)
	{
		$this->compostEmissions = $compostEmissions;

		return $this;
	}
}