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
require_once "File.php";

class Treatment
{
	private string $wasteList;
	private string $emissionsList;
	private array $services;
	private array $neighbourhoods;
	private array $wastes;

	public function __construct($wasteList, $emissionsList)
	{
		$this->wasteList = $wasteList;
		$this->emissionsList = $emissionsList;
		$this->loadData();
	}

	
	/**
	 * readJSON
	 *
	 * @param  JSONInterface $file
	 * @return Object
	 */
	public function readJson(JSONInterface $file): Object
	{
		return $file->read();
	}
	
	/**
	 * Find carbon emissions values of waste type
	 *
	 * @param  Waste $waste
	 * @return void
	 */
	private function findEmissionsValues(Waste $waste):Waste
	{
		$obj = $this->readJson(new File($this->emissionsList));
		$class = get_class($waste);
		switch ($class)
		{
			case 'OtherWaste':
				$waste->setIncinerationEmissions($obj->autre->incineration);
				break;
			case 'MetalWaste':
				$waste
					->setIncinerationEmissions($obj->metaux->incineration)
					->setRecyclingEmissions($obj->metaux->recyclage);
				break;
			case 'GlassWaste':
				$waste
					->setIncinerationEmissions($obj->verre->incineration)
					->setRecyclingEmissions($obj->verre->recyclage);
				break;
			case 'PaperWaste':
				$waste
					->setIncinerationEmissions($obj->papier->incineration)
					->setRecyclingEmissions($obj->papier->recyclage);
				break;
			case 'OrganicWaste':
				$waste
					->setIncinerationEmissions($obj->organique->incineration)
					->setCompostEmissions($obj->organique->compostage);
				break;
			case 'PETWaste':
				$waste
					->setIncinerationEmissions($obj->plastiques->PET->incineration)
					->setRecyclingEmissions($obj->plastiques->PET->recyclage);
				break;
			case 'PVCWaste':
				$waste
					->setIncinerationEmissions($obj->plastiques->PVC->incineration)
					->setRecyclingEmissions($obj->plastiques->PVC->recyclage);
				break;
			case 'PCWaste':
				$waste
					->setIncinerationEmissions($obj->plastiques->PC->incineration)
					->setRecyclingEmissions($obj->plastiques->PC->recyclage);
				break;
			case 'PEHDWaste':
				$waste
					->setIncinerationEmissions($obj->plastiques->PEHD->incineration)
					->setRecyclingEmissions($obj->plastiques->PEHD->recyclage);
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
		$listServices = [];
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
			array_push($listServices, $newService);
		}

		$this->services = $listServices;
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
		$listWastes = [];
		$listNeighbourhoods = [];

		foreach ($neighbourhoods as $neighbourhood)
		{
			$newNeighbourhood = null;
			$newNeighbourhood = new Neighbourhood();
			$newNeighbourhood->setPopulation($neighbourhood->population);
			array_push($listNeighbourhoods, $newNeighbourhood);
			
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
							$newWaste->setNeighbourhood($newNeighbourhood);
							$this->findEmissionsValues($newWaste);
							array_push($listWastes, $newWaste);
						}
						break;
					
					default:
						# code...
						break;
				}
				if ( isset($newWaste) && $newWaste != null && $key != "plastiques" )
				{
					$newWaste->setQuantity($value);
					$newWaste->setNeighbourhood($newNeighbourhood);
					$this->findEmissionsValues($newWaste);
					array_push($listWastes, $newWaste);
				}
			}
			$this->neighbourhoods = $listNeighbourhoods;
			$this->wastes = $listWastes;
		}
		return $this;
	}

	public function loadData()
	{
		$obj = $this->readJson(new File($this->wasteList));
		$neighbourhoods = $obj->quartiers;
		$services = $obj->services;
		$this->createServices($services);
		$this->createNeighbourhoodWaste($neighbourhoods);
	}

	public function testCreationObjects():void
	{
		var_dump($this->neighbourhoods);
		var_dump($this->services);
		var_dump($this->wastes);
	}

	public function sendWaste():void
	{
		if ( isset($this->wastes) && isset($this->services) )
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

					foreach ( $this->wastes as $waste )
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
					$service->setUsedCapacity($serviceCapacity+1);
					$serviceUsedCapacity = $service->getUsedCapacity();
				}
			}
		}
	}
}