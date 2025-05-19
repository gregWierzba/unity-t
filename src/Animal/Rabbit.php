<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;

final class Rabbit extends FurBearerAnimal
{
    public function __construct(string $name)
    {
        parent::__construct($name, Species::RABBIT, DietTypes::HERBIVORE);
    }
}
