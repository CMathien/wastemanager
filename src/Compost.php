<?php
require_once "Service.php";
require_once "CompostInterface.php";

class Compost extends Service implements CompostInterface
{
	private int $boxes;
	
	public function getName():string
	{
		return "composteur";
	}

	/**
	 * Get the value of boxes
	 */ 
	public function getBoxes():int
	{
		return $this->boxes;
	}

	/**
	 * Set the value of boxes
	 *
	 * @return  self
	 */ 
	public function setBoxes(int $boxes):self
	{
		$this->boxes = $boxes;

		return $this;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity(int $capacity):self
	{
		$this->capacity = $capacity * $this->boxes;

		return $this;
	}

	public function treatWaste(CompostInterface $waste):void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			echo $wasteQuantity . " tonnes de déchets ont été compostées. Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . "<br>";
			$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getCompostEmissions());
			$this->setWasteRepartition($waste->getName(), $wasteQuantity);

		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de déchets ont été compostées. Il reste " . $untreatedWaste . " tonnes de déchets à traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . "<br>";
			$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getCompostEmissions());
			$this->setWasteRepartition($waste->getName(), $wasteQuantity - $untreatedWaste);
		}
	}
}