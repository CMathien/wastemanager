<?php

class Incinerator extends Service
{
	private $lines;
	
	/**
	 * Get the value of lines
	 */ 
	public function getlines()
	{
		return $this->lines;
	}

	/**
	 * Set the value of lines
	 *
	 * @return  self
	 */ 
	public function setlines($lines)
	{
		$this->lines = $lines;

		return $this;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity($capacity)
	{
		$this->capacity = $capacity * $this->lines;

		return $this;
	}
}