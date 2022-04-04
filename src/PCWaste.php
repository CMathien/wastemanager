<?php
require_once "Waste.php";
require_once "IncineratorInterface.php";
require_once "PCInterface.php";
require_once "PlasticInterface.php";

class PCWaste extends Waste implements IncineratorInterface, PCInterface, PlasticInterface
{
	private int $recyclingEmissions;

	/**
	 * Get the value of recyclingEmissions
	 */ 
	public function getRecyclingEmissions():int
	{
		return $this->recyclingEmissions;
	}

	/**
	 * Set the value of recyclingEmissions
	 *
	 * @return  self
	 */ 
	public function setRecyclingEmissions(int $recyclingEmissions):self
	{
		$this->recyclingEmissions = $recyclingEmissions;

		return $this;
	}
}