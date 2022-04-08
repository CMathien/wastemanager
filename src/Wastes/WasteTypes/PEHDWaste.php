<?php
namespace Wastes\WasteTypes;

use Wastes\AbstractWaste;
use Wastes\WasteServiceInterfaces\{IncineratorInterface,PlasticInterface, PEHDInterface};

class PEHDWaste extends AbstractWaste implements IncineratorInterface, PEHDInterface, PlasticInterface
{
	private int $recyclingEmissions;
	
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName():string
	{
		return "plastique PEHD";
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