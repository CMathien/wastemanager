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
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			echo $wasteQuantity . " tonnes de d�chets ont �t� trait�es (verre). Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . PHP_EOL;
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de d�chets ont �t� trait�es (verre). Il reste " . $untreatedWaste . " tonnes de d�chets � traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . PHP_EOL;
		}
		
	}
}