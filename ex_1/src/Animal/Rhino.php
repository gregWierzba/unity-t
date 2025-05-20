<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;
use UnitryT\Animal\Species;

final class Rhino extends Animal
{
    public function __construct(string $name)
    {
        parent::__construct($name, Species::RHINO, DietTypes::HERBIVORE);
    }
}
