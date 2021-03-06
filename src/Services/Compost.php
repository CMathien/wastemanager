<?php
namespace Services;

use Services\AbstractService;
use Wastes\WasteServiceInterfaces\CompostInterface;

class Compost extends AbstractService implements CompostInterface
{
	private int $boxes;
		
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return "composteur";
	}

	/**
	 * Get the value of boxes
	 */ 
	public function getBoxes(): int
	{
		return $this->boxes;
	}

	/**
	 * Set the value of boxes
	 *
	 * @return self
	 */ 
	public function setBoxes(int $boxes): self
	{
		$this->boxes = $boxes;

		return $this;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return self
	 */ 
	public function setCapacity(int $capacity): self
	{
		$capacity = $capacity * $this->boxes;
		return parent::setCapacity($capacity);
	}

	public function treatWaste(CompostInterface $waste): void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getCompostEmissions());
			$this->addWasteRepartition($waste->getName(), $wasteQuantity);

		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getCompostEmissions());
			$this->addWasteRepartition($waste->getName(), $wasteQuantity - $untreatedWaste);
		}
	}
}