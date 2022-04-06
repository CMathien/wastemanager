<?php
require_once "Waste.php";
require_once "IncineratorInterface.php";
require_once "CompostInterface.php";

class OrganicWaste extends Waste implements IncineratorInterface, CompostInterface
{
	private int $compostEmissions;

	public function getName():string
	{
		return "déchet organique";
	}
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