<?php
require_once "Waste.php";
require_once "IncineratorInterface.php";
require_once "PETInterface.php";
require_once "PlasticInterface.php";

class PETWaste extends Waste implements IncineratorInterface, PETInterface, PlasticInterface
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