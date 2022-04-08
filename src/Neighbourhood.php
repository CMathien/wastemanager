<?php

class Neighbourhood
{
	private int $population;
	private array $wastes = [];
	
	/**
	 * add waste to array $wastes
	 *
	 * @param  AbstractWaste $waste
	 * @return void
	 */
	public function addWaste(AbstractWaste $waste)
	{
		$this->wastes[] = $waste;
		return $this;
	}
	/**
	 * Get the value of population
	 */ 
	public function getPopulation():int
	{
		return $this->population;
	}

	/**
	 * Set the value of population
	 *
	 * @return  self
	 */ 
	public function setPopulation(int $population):self
	{
		$this->population = $population;

		return $this;
	}

	/**
	 * Get the value of wastes
	 * 
	 * @return  array
	 */ 
	public function getWastes():array
	{
		return $this->wastes;
	}
}