<?php
require_once "Waste.php";

class MetalWaste extends Waste
{
	private $recyclingEmissions;

	/**
	 * Get the value of recyclingEmissions
	 */ 
	public function getRecyclingEmissions()
	{
		return $this->recyclingEmissions;
	}

	/**
	 * Set the value of recyclingEmissions
	 *
	 * @return  self
	 */ 
	public function setRecyclingEmissions($recyclingEmissions)
	{
		$this->recyclingEmissions = $recyclingEmissions;

		return $this;
	}
}