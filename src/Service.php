<?php

abstract class Service
{
	private int $capacity;
	private Neighbourhood $neighbourhood;

	/**
	 * Get the value of capacity
	 */ 
	public function getCapacity():int
	{
		return $this->capacity;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity(int $capacity):self
	{
		$this->capacity = $capacity;

		return $this;
	}

	/**
	 * Get the value of neighbourhood
	 */ 
	public function getNeighbourhood():Neighbourhood
	{
		return $this->neighbourhood;
	}

	/**
	 * Set the value of neighbourhood
	 *
	 * @return  self
	 */ 
	public function setNeighbourhood(Neighbourhood $neighbourhood)
	{
		$this->neighbourhood = $neighbourhood;

		return $this;
	}

	private function isAllowed()
	{
		//should check type 
	}

	private function calculateEmissions()
	{
		//should calculate the emissions ()
	}

	
}