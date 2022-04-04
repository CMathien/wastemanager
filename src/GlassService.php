<?php
require_once "Service.php";
require_once "GlassInterface.php";

class GlassService extends Service implements GlassInterface
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

	public function treatWaste(GlassInterface $waste):void
	{
		
	}
}