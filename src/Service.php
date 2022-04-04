<?php

abstract class Service
{
	protected int $capacity;

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

	private function isAllowed()
	{
		//should check type 
	}

	private function calculateEmissions()
	{
		//should calculate the emissions ()
	}

}