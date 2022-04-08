<?php
namespace Services;

abstract class AbstractService
{
	protected int $capacity;
	protected int $usedCapacity;
	protected int $emissions = 0;
	protected array $wasteRepartition = [];

	/**
	 * Get the value of capacity
	 * @return int
	 */ 
	public function getCapacity(): int
	{
		return $this->capacity;
	}

	/**
	 * Set the value of capacity
	 *
	 * @return self
	 */ 
	public function setCapacity(int $capacity): self
	{
		$this->capacity = $capacity;

		return $this;
	}

	/**
	 * Get the value of usedCapacity
	 * 
	 * @return int
	 */ 
	public function getUsedCapacity(): int
	{
		return $this->usedCapacity;
	}

	/**
	 * Set the value of usedCapacity
	 *
	 * @return self
	 */ 
	public function setUsedCapacity($usedCapacity): self
	{
		$this->usedCapacity = $usedCapacity;

		return $this;
	}

	/**
	 * Get the value of emissions
	 * 
	 * @return int
	 */ 
	public function getEmissions(): int
	{
		return $this->emissions;
	}

	/**
	 * Set the value of emissions
	 *
	 * @param int $emissions
	 * @return self
	 */ 
	public function setEmissions(int $emissions): self
	{
		$this->emissions = $emissions;

		return $this;
	}

	/**
	 * Get the value of wasteRepartition
	 * @return array
	 */ 
	public function getWasteRepartition(): array
	{
		return $this->wasteRepartition;
	}

	/**
	 * Set the value of wasteRepartition
	 *
	 * @return self
	 */ 
	public function addWasteRepartition($key, $value): self
	{
		if ( !isset($this->wasteRepartition[$key]) )
		{
			$this->wasteRepartition[$key] = 0;

		}
		$this->wasteRepartition[$key] += $value;
		
		return $this;
	}
	
	/**
	 * display the emissions for one service
	 *
	 * @return void
	 */
	public function displayServiceEmissions(): void
	{
		echo ucfirst($this->getName())." : ".number_format($this->getEmissions(),0,","," ")." t de CO2<br>";
	}
	
	/**
	 * display the waste repartition for one service
	 *
	 * @return void
	 */
	public function displayServiceWasteRepartition(): void
	{
		echo "<table><tr><th colspan=2>".ucfirst($this->getName())."</th><tr>";
		if ( !empty($this->getWasteRepartition()) )
		{
			foreach ( $this->getWasteRepartition() as $item => $value )
			{
				echo "<tr><td>".ucfirst($item)."</td><td>".number_format($value,0,","," ")." t</td></tr>";
			}
		}
		else 
		{
			echo "<tr><td colspan=2>Aucun déchet traité par ce service</td></tr>";
		}
	}
}