<?php
require_once "Service.php";
require_once "CompostInterface.php";

class Compost extends Service implements CompostInterface
{
	private int $boxes;
	
	/**
	 * Get the value of boxes
	 */ 
	public function getBoxes():int
	{
		return $this->boxes;
	}

	/**
	 * Set the value of boxes
	 *
	 * @return  self
	 */ 
	public function setBoxes(int $boxes):self
	{
		$this->boxes = $boxes;

		return $this;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity(int $capacity):self
	{
		$this->capacity = $capacity * $this->boxes;

		return $this;
	}

	public function treatWaste(CompostInterface $waste):void
	{
		
	}
}