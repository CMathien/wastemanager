<?php

class Neighbourhood
{
	private $id;
	private $population;

	/**
	 * Get the value of id
	 */ 
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 *
	 * @return  self
	 */ 
	public function setId($id)
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the value of population
	 */ 
	public function getPopulation()
	{
		return $this->population;
	}

	/**
	 * Set the value of population
	 *
	 * @return  self
	 */ 
	public function setPopulation($population)
	{
		$this->population = $population;

		return $this;
	}
}