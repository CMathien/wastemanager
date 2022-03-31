<?php

class Compost extends Service
{
	private $boxes;
	
	/**
	 * Get the value of boxes
	 */ 
	public function getBoxes()
	{
		return $this->boxes;
	}

	/**
	 * Set the value of boxes
	 *
	 * @return  self
	 */ 
	public function setBoxes($boxes)
	{
		$this->boxes = $boxes;

		return $this;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity($capacity)
	{
		$this->capacity = $capacity * $this->boxes;

		return $this;
	}
}