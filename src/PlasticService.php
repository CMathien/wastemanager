<?php
require_once "Service.php";
require_once "PlasticInterface.php";

class PlasticService extends Service implements PlasticInterface
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

	public function treatWaste(PlasticInterface $waste):void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			echo $wasteQuantity . " tonnes de déchets ont été traitées (plastique). Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . PHP_EOL;
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de déchets ont été traitées (plastique). Il reste " . $untreatedWaste . " tonnes de déchets à traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . PHP_EOL;
		}
		
	}
}