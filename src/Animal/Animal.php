<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;
use UnitryT\Diet\MealEnum;
use InvalidArgumentException;

/**
 * Abstract class for all animals
 */
abstract class Animal
{
    /**
     * Creates a new animal instance
     *
     * @param string $name The name of the animal
     * @param Species $species The species of the animal
     * @param DietTypes $diet The diet type of the animal
     */
     public function __construct(
         public readonly string $name,
         public readonly Species $species,
         public readonly DietTypes $diet
     ) {
     }

    /**
     * Returns the animal's specie and name
     */
    public function __toString(): string
    {
        return $this->species->value . ' ' . $this->name;
    }

    /**
     * Returns the animal's name and the meal it is eating
     */
    public function eat(MealEnum $meal): string
    {
        if (!$this->canEat($meal)) {
            throw new InvalidArgumentException(sprintf('%s cannot eat %s', $this->name, $meal->value));
        }

        return $this->name . ' eats ' . $meal->value;
    }

    /**
     * Returns true if the animal can eat the meal
     */
    public function canEat(MealEnum $meal): bool
    {
        return in_array($meal, $this->diet->meals(), true);
    }
}
