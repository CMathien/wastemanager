<?php

class Waste
{
	private $wasteType;
	private $incinerationEmissions;
	// private Neighbourhood $neighbourhood;
	static $instances=array();

	public function __construct() {
	  Waste::$instances[] = $this;
	}

	/**
	 * Get the value of wasteType
	 */ 
	public function getWasteType()
	{
		return $this->wasteType;
	}

	/**
	 * Set the value of wasteType
	 *
	 * @return  self
	 */ 
	public function setWasteType($wasteType)
	{
		$this->wasteType = $wasteType;

		return $this;
	}

	/**
	 * Get the value of incinerationEmissions
	 */ 
	public function getIncinerationEmissions()
	{
		return $this->incinerationEmissions;
	}

	/**
	 * Set the value of incinerationEmissions
	 *
	 * @return  self
	 */ 
	public function setIncinerationEmissions($incinerationEmissions)
	{
		$this->incinerationEmissions = $incinerationEmissions;

		return $this;
	}

	// /**
	//  * Get the value of neighbourhood
	//  */ 
	// public function getNeighbourhood()
	// {
	// 	return $this->neighbourhood;
	// }

	// /**
	//  * Set the value of neighbourhood
	//  *
	//  * @return  self
	//  */ 
	// public function setNeighbourhood($neighbourhood)
	// {
	// 	$neighbourhood = new Neighbourhood;

	// 	$this->neighbourhood = $neighbourhood;

	// 	return $this;
	// }
}
