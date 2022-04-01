<?php
require_once "Waste.php";

class OrganicWaste extends Waste
{
	private int $compostEmissions;

	/**
	 * Get the value of compostEmissions
	 */ 
	public function getCompostEmissions():int
	{
		return $this->compostEmissions;
	}

	/**
	 * Set the value of compostEmissions
	 *
	 * @return  self
	 */ 
	public function setCompostEmissions(int $compostEmissions):self
	{
		$this->compostEmissions = $compostEmissions;

		return $this;
	}
}