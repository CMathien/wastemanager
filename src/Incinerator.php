<?php
require_once "Service.php";
require_once "IncineratorInterface.php";

class Incinerator extends Service implements IncineratorInterface
{
	private int $lines;
	
	/**
	 * Get the value of lines
	 */ 
	public function getLines():int
	{
		return $this->lines;
	}

	/**
	 * Set the value of lines
	 *
	 * @return  self
	 */ 
	public function setLines(int $lines):self
	{
		$this->lines = $lines;

		return $this;
	}

	// /**
	//  * Set the value of capacity
	//  *
	//  * @return  self
	//  */ 
	// public function setCapacity(int $capacity):self
	// {
	// 	$this->capacity = $capacity * $this->lines;

	// 	return $this;
	// }

	public function treatWaste(IncineratorInterface $waste):void
	{
		
	}
}