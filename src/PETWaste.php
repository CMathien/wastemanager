<?php
require_once "AbstractWaste.php";
require_once "IncineratorInterface.php";
require_once "PETInterface.php";
require_once "PlasticInterface.php";

class PETWaste extends AbstractWaste implements IncineratorInterface, PETInterface, PlasticInterface
{
	private int $recyclingEmissions;
	
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName():string
	{
		return "plastique PET";
	}

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