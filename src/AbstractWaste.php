<?php

abstract class AbstractWaste
{
	private int $incinerationEmissions;
	private int $quantity;

	/**
	 * Get the value of incinerationEmissions
	 */ 
	public function getIncinerationEmissions():int
	{
		return $this->incinerationEmissions;
	}

	/**
	 * Set the value of incinerationEmissions
	 *
	 * @return  self
	 */ 
	public function setIncinerationEmissions(int $incinerationEmissions):AbstractWaste
	{
		$this->incinerationEmissions = $incinerationEmissions;

		return $this;
	}

	/**
	 * Get the value of quantity
	 */ 
	public function getQuantity()
	{
		return $this->quantity;
	}

	/**
	 * Set the value of quantity
	 *
	 * @return  self
	 */ 
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;

		return $this;
	}
	
	/**
	 * return type of waste
	 *
	 * @return string
	 */
	public function getType():string
	{
		return str_replace("Waste","",get_class($this));
	}

}
