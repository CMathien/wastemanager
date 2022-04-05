<?php
require_once "JSONInterface.php";

class File implements JSONInterface
{
	private string $url;
	
	public function __construct($url)
	{
		$this->url = $url;
	}

	/**
	 * Read JSON and generate an object with the JSON data
	 *
	 * @param  string $url
	 * @return Object
	 */
	public function read():Object
	{
		$data = file_get_contents($this->url);
		$obj = json_decode($data);
		return $obj;
	}
}
