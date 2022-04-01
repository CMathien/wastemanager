<?php
require_once "Service.php";

class GlassService extends Service
{
	private bool $deposit;

	/**
	 * Get the value of deposit
	 */ 
	public function getDeposit():bool
	{
		return $this->deposit;
	}

	/**
	 * Set the value of deposit
	 *
	 * @return  self
	 */ 
	public function setDeposit(bool $deposit):self
	{
		$this->deposit = $deposit;

		return $this;
	}
}