<?php
require_once "Service.php";

class PlasticService extends Service
{
	private array $allowedPlastics;

	/**
	 * Get the value of allowedPlastics
	 */ 
	public function getAllowedPlastics():array
	{
		return $this->allowedPlastics;
	}

	/**
	 * Set the value of allowedPlastics
	 *
	 * @return  self
	 */ 
	public function setAllowedPlastics(array $allowedPlastics):self
	{
		$this->allowedPlastics = $allowedPlastics;

		return $this;
	}
}