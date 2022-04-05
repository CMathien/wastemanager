<?php

abstract class Service
{
	protected int $capacity;
	protected int $usedCapacity;


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
	 * Get the value of usedCapacity
	 */ 
	public function getUsedCapacity():int
	{
		return $this->usedCapacity;
	}

	/**
	 * Set the value of usedCapacity
	 *
	 * @return  self
	 */ 
	public function setUsedCapacity($usedCapacity):self
	{
		$this->usedCapacity = $usedCapacity;

		return $this;
	}
}