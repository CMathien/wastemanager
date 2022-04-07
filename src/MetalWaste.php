<?php
require_once "Waste.php";
require_once "IncineratorInterface.php";
require_once "MetalInterface.php";

class MetalWaste extends Waste implements IncineratorInterface, MetalInterface
{
	private int $recyclingEmissions;
	
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName():string
	{
		return "métal";
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