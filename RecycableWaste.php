<?php

class RecycableWaste extends Waste
{
	private $recyclingEmissions;

	public function __construct() {
		Waste::$instances[] = $this;
	}

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