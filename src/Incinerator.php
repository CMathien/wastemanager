<?php
require_once "Service.php";
require_once "IncineratorInterface.php";

class Incinerator extends Service implements IncineratorInterface
{
	private int $lines;
	
	/**
	 * Get the value of lines
	 */ 
	public function getLines():int
	{
		return $this->lines;
	}

	/**
	 * Set the value of lines
	 *
	 * @return  self
	 */ 
	public function setLines(int $lines):self
	{
		$this->lines = $lines;

		return $this;
	}

	// /**
	//  * Set the value of capacity
	//  *
	//  * @return  self
	//  */ 
	// public function setCapacity(int $capacity):self
	// {
	// 	$this->capacity = $capacity * $this->lines;

	// 	return $this;
	// }

	public function treatWaste(IncineratorInterface $waste):void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			echo $wasteQuantity . " tonnes de déchets ont été incinérées. Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . "<br>";
			$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getIncinerationEmissions());
			$this->setWasteRepartition(get_class($waste), $wasteQuantity);
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de déchets ont été incinérées. Il reste " . $untreatedWaste . " tonnes de déchets à traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . "<br>";
			$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getIncinerationEmissions());
			$this->setWasteRepartition(get_class($waste), $wasteQuantity - $untreatedWaste);
		}
		
	}
}