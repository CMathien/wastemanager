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
			echo $wasteQuantity . " tonnes de d�chets ont �t� incin�r�es. Nouveau remplissage : " . $newUsedCapacity . "/" . $this->getCapacity() . PHP_EOL;
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			echo $wasteQuantity - $untreatedWaste . " tonnes de d�chets ont �t� incin�r�es. Il reste " . $untreatedWaste . " tonnes de d�chets � traiter. Nouveau remplissage : " . $this->getUsedCapacity() . "/" . $this->getCapacity() . PHP_EOL;
		}
		
	}
}