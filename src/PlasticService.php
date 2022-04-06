<?php
require_once "Service.php";
require_once "PlasticInterface.php";

class PlasticService extends Service implements PlasticInterface
{
	private array $allowedPlastics;

	public function getName():string
	{
		$name = "service de recyclage spécial plastique";
		if (isset($this->allowedPlastics))
		{
			$name = $name . " (" . implode(", ", $this->allowedPlastics) . ")";
		}
		return $name;
	}
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
		if ( in_array(str_replace("Waste","",get_class($waste)), $this->allowedPlastics) )
		{
			$wasteQuantity = $waste->getQuantity();
			$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
			if ( $availableCapacity >= $wasteQuantity )
			{
				$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
				$this->setUsedCapacity($newUsedCapacity);
				$waste->setQuantity(0);
				echo $wasteQuantity . " tonnes de déchets ont été traitées (plastique). Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . "<br>";
				$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getRecyclingEmissions());
				$this->setWasteRepartition($waste->getName(), $wasteQuantity);
			}
			else
			{
				$untreatedWaste = $wasteQuantity - $availableCapacity;
				$this->setUsedCapacity($this->getCapacity());
				$waste->setQuantity($untreatedWaste);
				echo $wasteQuantity - $untreatedWaste . " tonnes de déchets ont été traitées (plastique). Il reste " . $untreatedWaste . " tonnes de déchets à traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . "<br>";
				$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getRecyclingEmissions());
				$this->setWasteRepartition($waste->getName(), $wasteQuantity - $untreatedWaste);
			}
		}
	}
}