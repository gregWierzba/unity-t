<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;

final class Tiger  extends FurBearerAnimal
{
    public function __construct(string $name)
    {
        parent::__construct($name, Species::TIGER, DietTypes::CARNIVORE);
    }
}
