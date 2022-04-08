<?php
namespace Wastes\WasteTypes;

use Wastes\AbstractWaste;
use Wastes\WasteServiceInterfaces\{IncineratorInterface,PaperInterface};

class PaperWaste extends AbstractWaste implements IncineratorInterface, PaperInterface
{
	private int $recyclingEmissions;
	
	/**
	 * get name
	 *
	 * @return string
	 */
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