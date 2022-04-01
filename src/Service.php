<?php

abstract class Service
{
	private $treatmentType;
	private $capacity;

	/**
	 * Get the value of treatmentType
	 */ 
	public function getTreatmentType()
	{
		return $this->treatmentType;
	}

	/**
	 * Set the value of treatmentType
	 *
	 * @return  self
	 */ 
	public function setTreatmentType($treatmentType)
	{
		$this->treatmentType = $treatmentType;

		return $this;
	}

	/**
	 * Get the value of capacity
	 */ 
	public function getCapacity()
	{
		return $this->capacity;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity($capacity)
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