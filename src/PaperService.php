<?php
require_once "Service.php";
require_once "PaperInterface.php";

class PaperService extends Service implements PaperInterface
{
	public function treatWaste(PaperInterface $waste):void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			echo $wasteQuantity . " tonnes de d�chets ont �t� trait�es (papier). Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . PHP_EOL;
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de d�chets ont �t� trait�es (papier). Il reste " . $untreatedWaste . " tonnes de d�chets � traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . PHP_EOL;
		}
		
	}
}