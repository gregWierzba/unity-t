<?php

declare(strict_types=1);

namespace UnitryT\Animal;

use UnitryT\Diet\DietTypes;
use UnitryT\Diet\MealEnum;

abstract class Animal
{   
    public function __construct(
        public readonly string $name,
        public readonly Species $specie,
        public readonly DietTypes $diet
    ) {
    }

    /**
     * Returns the animal's specie and name
     */
    public function __toString(): string
    {
        return $this->specie->value . ' ' . $this->name;
    }

    /**
     * Returns the animal's name and the meal it is eating
     */
    public function eat(MealEnum $meal): string
    {
        if (!$this->canEat($meal)) {
            throw new \Exception(sprintf('%s cannot eat %s', $this->name, $meal->value));
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
