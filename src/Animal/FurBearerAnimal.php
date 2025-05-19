<?php

declare(strict_types=1);

namespace UnitryT\Animal;

abstract class FurBearerAnimal extends Animal
{
    /**
     * Returns the animal's name and that it is being groomed
     */
    public function groom(): string
    {
        return $this->name . ' is being groomed';
    }
}
