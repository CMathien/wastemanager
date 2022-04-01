<?php
require_once "Service.php";

class GlassService extends Service
{
	private $deposit;


	/**
	 * Get the value of deposit
	 */ 
	public function getDeposit()
	{
		return $this->deposit;
	}

	/**
	 * Set the value of deposit
	 *
	 * @return  self
	 */ 
	public function setDeposit($deposit)
	{
		$this->deposit = $deposit;

		return $this;
	}
}