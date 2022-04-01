<?php

abstract class Waste
{
	private int $incinerationEmissions;
	private Neighbourhood $neighbourhood;

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
	public function setIncinerationEmissions(int $incinerationEmissions):Waste
	{
		$this->incinerationEmissions = $incinerationEmissions;

		return $this;
	}

	/**
	 * Get the value of neighbourhood
	 */ 
	public function getNeighbourhood():Neighbourhood
	{
		return $this->neighbourhood;
	}

	/**
	 * Set the value of neighbourhood
	 *
	 * @return  self
	 */ 
	public function setNeighbourhood(Neighbourhood $neighbourhood):self
	{
		$this->neighbourhood = $neighbourhood;

		return $this;
	}
}
