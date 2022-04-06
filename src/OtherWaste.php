<?php
require_once "Waste.php";
require_once "IncineratorInterface.php";

class OtherWaste extends Waste implements IncineratorInterface
{
	public function getName():string
	{
		return "autre";
	}
}