<?php
require_once "AbstractWaste.php";
require_once "IncineratorInterface.php";
require_once "GlassInterface.php";

class GlassWaste extends AbstractWaste implements IncineratorInterface, GlassInterface
{
	private int $recyclingEmissions;

	public function getName():string
	{
		return "verre";
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