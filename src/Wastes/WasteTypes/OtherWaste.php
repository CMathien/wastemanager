<?php
namespace Wastes\WasteTypes;

use Wastes\AbstractWaste;
use Wastes\WasteServiceInterfaces\IncineratorInterface;

class OtherWaste extends AbstractWaste implements IncineratorInterface
{
	public function getName(): string
	{
		return "autre";
	}
}