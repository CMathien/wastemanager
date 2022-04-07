<?php
require_once "JSONInterface.php";
class Emissions
{
	private Object $emissions;
	
	/**
	 * load the values of JSON file in $emissions
	 *
	 * @param  JSONInterface $file
	 * @return self
	 */
	public function loadFile(JSONInterface $file):self
	{
		$emissions = $file->read();
		$this->emissions = $emissions;
		return $this;
	}
	
	/**
	 * getEmissions
	 *
	 * @return Object
	 */
	public function getEmissions():Object
	{
		return $this->emissions;
	}
}