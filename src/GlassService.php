<?php
require_once "AbstractService.php";
require_once "GlassInterface.php";

class GlassService extends AbstractService implements GlassInterface
{
	private bool $deposit;
	
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName():string
	{
		return "service de recyclage spécial verre";
	}

	/**
	 * Get the value of deposit
	 */ 
	public function getDeposit():bool
	{
		return $this->deposit;
	}

	/**
	 * Set the value of deposit
	 *
	 * @return  self
	 */ 
	public function setDeposit(bool $deposit):self
	{
		$this->deposit = $deposit;

		return $this;
	}
	
	/**
	 * treat waste
	 *
	 * @param  GlassInterface $waste
	 * @return void
	 */
	public function treatWaste(GlassInterface $waste):void
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