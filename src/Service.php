<?php

abstract class Service
{
	protected int $capacity;
	protected int $usedCapacity;
	protected int $emissions;
	protected array $wasteRepartition;

	public function __construct()
	{
		$this->emissions = 0;
		$this->wasteRepartition = [];
	}
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

	/**
	 * Get the value of emissions
	 */ 
	public function getEmissions()
	{
		return $this->emissions;
	}

	/**
	 * Set the value of emissions
	 *
	 * @return  self
	 */ 
	public function setEmissions($emissions)
	{
		$this->emissions = $emissions;

		return $this;
	}

	/**
	 * Get the value of wasteRepartition
	 */ 
	public function getWasteRepartition()
	{
		return $this->wasteRepartition;
	}

	/**
	 * Set the value of wasteRepartition
	 *
	 * @return  self
	 */ 
	public function setWasteRepartition($key, $value)
	{
		if ( array_key_exists($key, $this->wasteRepartition) )
		{
			$old = $this->getWasteRepartition()[$key];
			$this->wasteRepartition[$key] = $old + $value;
		}
		else
		{
			$this->wasteRepartition[$key] = $value;
		}
		return $this;
	}

	public function displayServiceEmissions()
	{
		echo ucfirst($this->getName())." : ".number_format($this->getEmissions(),0,","," ")." tonnes de CO2 rejetées<br>";
	}

	public function displayServiceWasteRepartition()
	{
		echo "<table><tr><th colspan=2>".ucfirst($this->getName())."</th><tr>";
		foreach ( $this->getWasteRepartition() as $item => $value )
		{
			echo "<tr><td>".ucfirst($item)."</td><td>".number_format($value,0,","," ")." t</td></tr>";
		}
	}
}