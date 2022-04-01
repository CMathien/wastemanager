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

class Treatment
{
	private string $wasteList;
	private string $emissionsList;
	private array $services;
	private array $neighbourhoods;
	private array $waste;

	public function __construct($wasteList, $emissionsList)
	{
		$this->wasteList = $wasteList;
		$this->emissionsList = $emissionsList;
		$this->loadData();
	}

	/**
	 * Read JSON and generate an object with the JSON data
	 *
	 * @param  string $url
	 * @return Object
	 */
	private function readJSON(string $url):Object
	{
		$data = file_get_contents($url);
		$obj = json_decode($data);
		return $obj;
	}
	
	/**
	 * Find carbon emissions values of waste type
	 *
	 * @param  Object $waste
	 * @return Object
	 */
	private function findEmissionsValues(Object $waste):Object
	{
		$obj = $this->readJson($this->emissionsList);
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
	 * @return array
	 */
	function createServices(array $services):array
	{
		foreach ( $services as $service ) {
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
			array_push($services, $newService);
		}
		$this->services = $services;
		return $services;
	}
	
	/**
	 * Create the neighbouhoods ans waste
	 *
	 * @param  array $neighbourhoods
	 * @return array
	 */
	public function createNeighbourhoodWaste(array $neighbourhoods):array
	{
		foreach ($neighbourhoods as $neighbourhood)
		{
			$newNeighbourhood = new Neighbourhood();
			$newNeighbourhood->setPopulation($neighbourhood->population);
			foreach ($neighbourhood as $key=>$value )
			{
				switch ($key) {
					case 'autre':
						$newWaste = new OtherWaste();
						break;
					case 'metaux':
						$newWaste = new MetalWaste();
						break;
					//TODO Add other cases
					default:
						# code...
						break;
				}
				if ( isset($newWaste) )
				{
					$newWaste->setQuantity($value);
					$newWaste->setNeighbourhood($newNeighbourhood);
					$this->findEmissionsValues($newWaste);
					array_push($wastes, $newWaste);
				}
			}
		}

		return [];

	}

	public function loadData()
	{
		$obj = $this->readJSON($this->wasteList);
		$neighbourhoods = $obj->quartiers;
		$services = $obj->services;
		$this->createServices($services);
		$this->createNeighbourhoodWaste($neighbourhoods);
	}


}