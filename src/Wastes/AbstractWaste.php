<?php
namespace Wastes;

abstract class AbstractWaste
{
	private int $incinerationEmissions;
	private int $quantity;

	/**
	 * Get the value of incinerationEmissions
	 */ 
	public function getIncinerationEmissions(): int
	{
		return $this->incinerationEmissions;
	}

	/**
	 * Set the value of incinerationEmissions
	 *
	 * @return self
	 */ 
	public function setIncinerationEmissions(int $incinerationEmissions): self
	{
		$this->incinerationEmissions = $incinerationEmissions;

		return $this;
	}

	/**
	 * Get the value of quantity
	 */ 
	public function getQuantity(): int
	{
		return $this->quantity;
	}

	/**
	 * Set the value of quantity
	 *
	 * @return self
	 */ 
	public function setQuantity($quantity): self
	{
		$this->quantity = $quantity;
		return $this;
	}
	
	/**
	 * return type of waste
	 *
	 * @return string
	 */
	public function getType(): string
	{
		$classname = explode("\\",get_class($this));
		return str_replace("Waste","",end($classname));
	}
}
