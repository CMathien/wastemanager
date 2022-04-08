<?php
namespace Wastes\WasteTypes;

use Wastes\AbstractWaste;
use Wastes\WasteServiceInterfaces\{IncineratorInterface,GlassInterface};

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