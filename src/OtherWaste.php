<?php
require_once "AbstractWaste.php";
require_once "IncineratorInterface.php";

class OtherWaste extends AbstractWaste implements IncineratorInterface
{
	public function getName():string
	{
		return "autre";
	}
}