<?php
require_once "AbstractService.php";
require_once "IncineratorInterface.php";

class Incinerator extends AbstractService implements IncineratorInterface
{
	private int $lines;

	public function getName():string
	{
		return "incinérateur";
	}
	
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

	/**
	 * Set the value of capacity
	 *
	 * @return  self
	 */ 
	public function setCapacity(int $capacity):self
	{
		$capacity = $capacity * $this->lines;
		return parent::setCapacity($capacity);
	}
	
	/**
	 * treat waste
	 *
	 * @param  IncineratorInterface $waste
	 * @return void
	 */
	public function treatWaste(IncineratorInterface $waste):void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getIncinerationEmissions());
			$this->addWasteRepartition($waste->getName(), $wasteQuantity);
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getIncinerationEmissions());
			$this->addWasteRepartition($waste->getName(), $wasteQuantity - $untreatedWaste);
		}
		
	}
}