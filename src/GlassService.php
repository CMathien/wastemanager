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
			echo $wasteQuantity . " tonnes de déchets ont été traitées (verre). Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . "<br>";
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de déchets ont été traitées (verre). Il reste " . $untreatedWaste . " tonnes de déchets à traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . "<br>";
		}
		
	}
}