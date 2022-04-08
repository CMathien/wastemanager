<?php
namespace Services;

use Services\AbstractService;
use Wastes\WasteServiceInterfaces\PaperInterface;

class PaperService extends AbstractService implements PaperInterface
{	
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return "service de recyclage spécial papier";
	}
	
	/**
	 * treat waste
	 *
	 * @param PaperInterface $waste
	 * @return void
	 */
	public function treatWaste(PaperInterface $waste): void
	{
		$wasteQuantity = $waste->getQuantity();
		$availableCapacity = $this->getCapacity() - $this->getUsedCapacity();
		if ( $availableCapacity >= $wasteQuantity )
		{
			$newUsedCapacity = $this->getUsedCapacity() + $wasteQuantity;
			$this->setUsedCapacity($newUsedCapacity);
			$waste->setQuantity(0);
			$this->setEmissions($this->getEmissions() + $wasteQuantity * $waste->getRecyclingEmissions());
			$this->addWasteRepartition($waste->getName(), $wasteQuantity);
		}
		else
		{
			$untreatedWaste = $wasteQuantity - $availableCapacity;
			$this->setUsedCapacity($this->getCapacity());
			$waste->setQuantity($untreatedWaste);
			$this->setEmissions($this->getEmissions() + ($wasteQuantity - $untreatedWaste) * $waste->getRecyclingEmissions());
			$this->addWasteRepartition($waste->getName(), $wasteQuantity - $untreatedWaste);
		}
	}
}