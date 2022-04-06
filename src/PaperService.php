<?php
require_once "Service.php";
require_once "PaperInterface.php";

class PaperService extends Service implements PaperInterface
{
	public function getName():string
	{
		return "service de recyclage spécial papier";
	}

	public function treatWaste(PaperInterface $waste):void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			echo $wasteQuantity . " tonnes de déchets ont été traitées (papier). Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . "<br>";
			$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getRecyclingEmissions());
			$this->setWasteRepartition($waste->getName(), $wasteQuantity);
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de déchets ont été traitées (papier). Il reste " . $untreatedWaste . " tonnes de déchets à traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . "<br>";
			$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getRecyclingEmissions());
			$this->setWasteRepartition($waste->getName(), $wasteQuantity - $untreatedWaste);
		}
		
	}
}