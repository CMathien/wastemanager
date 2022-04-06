<?php
require_once "Waste.php";
require_once "IncineratorInterface.php";
require_once "PaperInterface.php";

class PaperWaste extends Waste implements IncineratorInterface, PaperInterface
{
	private int $recyclingEmissions;

	public function getName():string
	{
		return "papier";
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