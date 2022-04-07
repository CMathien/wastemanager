<?php
require_once "Incinerator.php";
require_once "Compost.php";
require_once "PlasticService.php";
require_once "PaperService.php";
require_once "MetalService.php";
require_once "GlassService.php";
require_once "Neighbourhood.php";
require_once "GlassWaste.php";
require_once "MetalWaste.php";
require_once "OrganicWaste.php";
require_once "OtherWaste.php";
require_once "PaperWaste.php";
require_once "PCWaste.php";
require_once "PEHDWaste.php";
require_once "PETWaste.php";
require_once "PVCWaste.php";
require_once "Emissions.php";
require_once "File.php";

class Treatment
{
	private array $services = [];
	private array $neighbourhoods = [];
	private Emissions $emissions;
	
	
	/**
	 * Get the value of emissions
	 */ 
	public function getEmissions()
	{
		return $this->emissions;
	}

	/**
	 * Set the value of emissions
	 *
	 * @return  self
	 */ 
	public function setEmissions($emissions)
	{
		$this->emissions = $emissions;

		return $this;
	}
	
	public function addNeighbourhood(Neighbourhood $neighbourhood)
	{
		$this->neighbourhoods[] = $neighbourhood;
		return $this;
	}

	public function addService(Service $service)
	{
		$this->services[] = $service;
		return $this;
	}
	/**
	 * Find carbon emissions values of waste type
	 *
	 * @param  Waste $waste
	 * @return void
	 */
	private function findEmissionsValues(Waste $waste):Waste
	{
		$ref = $this->getEmissions()->getEmissions();
		$class = get_class($waste);
		switch ($class)
		{
			case 'OtherWaste':
				$waste->setIncinerationEmissions($ref->autre->incineration);
				break;
			case 'MetalWaste':
				$waste
					->setIncinerationEmissions($ref->metaux->incineration)
					->setRecyclingEmissions($ref->metaux->recyclage);
				break;
			case 'GlassWaste':
				$waste
					->setIncinerationEmissions($ref->verre->incineration)
					->setRecyclingEmissions($ref->verre->recyclage);
				break;
			case 'PaperWaste':
				$waste
					->setIncinerationEmissions($ref->papier->incineration)
					->setRecyclingEmissions($ref->papier->recyclage);
				break;
			case 'OrganicWaste':
				$waste
					->setIncinerationEmissions($ref->organique->incineration)
					->setCompostEmissions($ref->organique->compostage);
				break;
			case 'PETWaste':
				$waste
					->setIncinerationEmissions($ref->plastiques->PET->incineration)
					->setRecyclingEmissions($ref->plastiques->PET->recyclage);
				break;
			case 'PVCWaste':
				$waste
					->setIncinerationEmissions($ref->plastiques->PVC->incineration)
					->setRecyclingEmissions($ref->plastiques->PVC->recyclage);
				break;
			case 'PCWaste':
				$waste
					->setIncinerationEmissions($ref->plastiques->PC->incineration)
					->setRecyclingEmissions($ref->plastiques->PC->recyclage);
				break;
			case 'PEHDWaste':
				$waste
					->setIncinerationEmissions($ref->plastiques->PEHD->incineration)
					->setRecyclingEmissions($ref->plastiques->PEHD->recyclage);
				break;
			default:
				# code...
				break;
		}
		return $waste;
	}
	
	/**
	 * Create waste treatment services
	 *
	 * @param  array $services
	 * @return self
	 */
	function createServices(array $services):self
	{
		foreach ( $services as $service ) {
			$newService = null;
			switch ($service->type) {
				case 'incinerateur':
					$newService = new Incinerator();
					$newService
						->setLines($service->ligneFour)
						->setCapacity($service->capaciteLigne);
					break;
				case 'recyclagePlastique':
					$newService = new PlasticService();
					$newService
						->setAllowedPlastics($service->plastiques)
						->setCapacity($service->capacite);
					break;
				case 'recyclagePapier':
					$newService = new PaperService();
					$newService
						->setCapacity($service->capacite);
					break;
				case 'recyclageVerre':
					$newService = new GlassService();
					$newService
						->setDeposit($service->consigne)
						->setCapacity($service->capacite);
					break;
				case 'recyclageMetaux':
					$newService = new MetalService();
					$newService
						->setCapacity($service->capacite);
					break;
				case 'composteur':
					$newService = new Compost();
					$newService
						->setBoxes($service->foyers)
						->setCapacity($service->capacite);
					break;
				default:
					# code...
					break;
			}
			$newService->setUsedCapacity(0);
			$this->addService($newService);
		}
		return $this;
	}
	
	/**
	 * Create the neighbouhoods and wastes
	 *
	 * @param  array $neighbourhoods
	 * @return self
	 */
	public function createNeighbourhoodWaste(array $neighbourhoods):self
	{
		foreach ($neighbourhoods as $neighbourhood)
		{
			$newNeighbourhood = null;
			$newNeighbourhood = new Neighbourhood();
			$newNeighbourhood->setPopulation($neighbourhood->population);
			$this->addNeighbourhood($newNeighbourhood);
			
			foreach ($neighbourhood as $key=>$value )
			{
				$newWaste = null;
				switch ($key) {
					case 'autre':
						$newWaste = new OtherWaste();
						break;
					case 'metaux':
						$newWaste = new MetalWaste();
						break;
					case 'verre':
						$newWaste = new GlassWaste();
						break;
					case 'organique':
						$newWaste = new OrganicWaste();
						break;
					case 'papier':
						$newWaste = new PaperWaste();
						break;
					case 'plastiques':
						foreach ( $value as $plasticType => $val)
						{
							switch ($plasticType) {
								case 'PET':
									$newWaste = new PETWaste();
									break;
								case 'PVC':
									$newWaste = new PVCWaste();
									break;
								case 'PC':
									$newWaste = new PCWaste();
									break;
								case 'PEHD':
									$newWaste = new PEHDWaste();
									break;
								default:
									# code...
									break;
							}
							$newWaste->setQuantity($val);
							$this->findEmissionsValues($newWaste);
							$newNeighbourhood->addWaste($newWaste);
						}
						break;
					
					default:
						# code...
						break;
				}
				if ( isset($newWaste) && $newWaste != null && $key != "plastiques" )
				{
					$newWaste->setQuantity($value);
					$this->findEmissionsValues($newWaste);
					$newNeighbourhood->addWaste($newWaste);
				}
			}
		}
		return $this;
	}
	
	/**
	 * load the services, the neigbourhoods and their wastes
	 *
	 * @param  JSONInterface $file
	 * @return void
	 */
	public function loadData(JSONInterface $file):void
	{
		$obj = $file->read();
		$neighbourhoods = $obj->quartiers;
		$services = $obj->services;
		$this->createServices($services);
		$this->createNeighbourhoodWaste($neighbourhoods);
		$this->orderServices();
	}
	
	/**
	 * Used to test the creation of neighbourhoods/services/wastes objects
	 *
	 * @return void
	 */
	public function testCreationObjects():void
	{
		var_dump($this->neighbourhoods);
		var_dump($this->services);
		var_dump($this->wastes);
	}
	
	/**
	 * Put Incinerator objects at the end of the array so that they are last treated
	 *
	 * @return void
	 */
	public function orderServices():void
	{
		$services = $this->services;
		$i = 0;
		foreach ( $services as $service )
		{
			if ( $service instanceof Incinerator )
			{
				$service_to_move = $service;
				unset($services[$i]);
				array_push($services, $service_to_move);
			}
			$i++;
		}
		$this->services = $services;
	}
		
	/**
	 * dispatch the waste to the corresponding service
	 *
	 * @return void
	 */
	public function dispatchWaste():void
	{
		if ( isset($this->neighbourhoods) && isset($this->services) )
		{
			$serviceCapacity = 0;
			$serviceUsedCapacity = 0;
			foreach ( $this->services as $service )
			{
				$serviceCapacity = $service->getCapacity();
				$serviceUsedCapacity = $service->getUsedCapacity();
				while ( $serviceUsedCapacity < $serviceCapacity )
				{
					$interface = array_values(class_implements($service))[0];
					foreach ($this->neighbourhoods as $neighbourhood )
					{
						foreach ( $neighbourhood->getWastes() as $waste )
						{
							if ( $waste->getQuantity() > 0 && in_array($interface, class_implements($waste)) && $serviceUsedCapacity < $serviceCapacity )
							{
								$wasteQuantity = $waste->getQuantity();
								$serviceUsedCapacity = $serviceUsedCapacity + $wasteQuantity;
								$service->treatWaste($waste);
								$serviceCapacity = $service->getCapacity();
								$serviceUsedCapacity = $service->getUsedCapacity();
							}
						}
					}

					$service->setUsedCapacity($serviceCapacity+1);
					$serviceUsedCapacity = $service->getUsedCapacity();
				}
			}
		}
	}
	
	/**
	 * Display the emissions of each service
	 *
	 * @return void
	 */
	public function emissionsByService():void
	{
		foreach ($this->services as $service )
		{
			$service->displayServiceEmissions();
		}
	}
	
	/**
	 * Display the global emissions
	 *
	 * @return void
	 */
	public function globalEmissions():void
	{
		$globalEmissions = 0;
		foreach ($this->services as $service )
		{
			$globalEmissions += $service->getEmissions();
		}
		echo "L'ensemble des services a émis ".number_format($globalEmissions,0,","," ")." tonnes de CO2.<br>";
	}
	
	/**
	 * Display the waste repartition in each service
	 *
	 * @return void
	 */
	public function wasteRepartition():void
	{
		foreach ($this->services as $service )
		{
			$service->displayServiceWasteRepartition();
		}
	}
}

