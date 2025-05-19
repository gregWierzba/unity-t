<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;
use UnitryT\Animal\Species;

final class Fox extends FurBearerAnimal
{
    public function __construct(string $name)
    {
        parent::__construct($name, Species::FOX, DietTypes::OMNIVORE);
    }

}