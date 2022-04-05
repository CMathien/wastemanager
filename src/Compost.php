<?php
require_once "Service.php";
require_once "CompostInterface.php";

class Compost extends Service implements CompostInterface
{
	private int $boxes;
	
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
			echo $wasteQuantity . " tonnes de d�chets ont �t� compost�es. Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . PHP_EOL;
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de d�chets ont �t� compost�es. Il reste " . $untreatedWaste . " tonnes de d�chets � traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . PHP_EOL;
		}
	}
}