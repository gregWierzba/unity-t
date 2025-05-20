<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;
use UnitryT\Animal\Species;

final class SnowLeopard extends FurBearerAnimal
{
    public function __construct(string $name)
    {
        parent::__construct($name, Species::SNOW_LEOPARD, DietTypes::CARNIVORE);
    }
}
