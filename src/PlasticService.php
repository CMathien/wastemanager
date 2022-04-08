<?php
require_once "AbstractService.php";
require_once "PlasticInterface.php";

class PlasticService extends AbstractService implements PlasticInterface
{
	private array $allowedPlastics;
	
	/**
	 * get name
	 *
	 * @return string
	 */
	public function getName():string
	{
		$name = "service de recyclage spécial plastique";
		if (isset($this->allowedPlastics))
		{
			$name = $name . " (" . implode(", ", $this->allowedPlastics) . ")";
		}
		return $name;
	}
	
	/**
	 * Get the value of allowedPlastics
	 */ 
	public function getAllowedPlastics():array
	{
		return $this->allowedPlastics;
	}

	/**
	 * Set the value of allowedPlastics
	 *
	 * @return  self
	 */ 
	public function setAllowedPlastics(array $allowedPlastics):self
	{
		$this->allowedPlastics = $allowedPlastics;

		return $this;
	}
	
	/**
	 * treat waste
	 *
	 * @param  PlasticInterface $waste
	 * @return void
	 */
	public function treatWaste(PlasticInterface $waste):void
	{
		if ( in_array($waste->getType(), $this->allowedPlastics) )
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
}