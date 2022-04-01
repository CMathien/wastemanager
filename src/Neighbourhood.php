<?php

class Neighbourhood
{
	private int $population;

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
}