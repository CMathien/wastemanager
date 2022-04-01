<?php

class Neighbourhood
{
	private int $id;
	private int $population;

	/**
	 * Get the value of id
	 */ 
	public function getId():int
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId(int $id):self
	{
		$this->id = $id;

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
}