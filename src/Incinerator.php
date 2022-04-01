<?php
require_once "Service.php";

class Incinerator extends Service
{
	private int $lines;
	
	/**
	 * Get the value of lines
	 */ 
	public function getlines():int
	{
		return $this->lines;
	}

	/**
	 * Set the value of lines
	 *
	 * @return  self
	 */ 
	public function setlines(int $lines):self
	{
		$this->lines = $lines;

		return $this;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity(int $capacity):self
	{
		$this->capacity = $capacity * $this->lines;

		return $this;
	}
}