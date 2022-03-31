<?php

class PlasticService extends Service
{
	private $allowedPlastics;

	/**
	 * Get the value of allowedPlastics
	 */ 
	public function getAllowedPlastics()
	{
		return $this->allowedPlastics;
	}

	/**
	 * Set the value of allowedPlastics
	 *
	 * @return  self
	 */ 
	public function setAllowedPlastics($allowedPlastics)
	{
		$this->allowedPlastics = $allowedPlastics;

		return $this;
	}

	private function isAllowed()
	{
		//should check type + plastic type 
	}
}