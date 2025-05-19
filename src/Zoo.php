<?php

declare(strict_types=1);

namespace UnitryT;

use UnitryT\Animal\Animal;
use UnitryT\Diet\MealEnum;
use UnitryT\Animal\FurBearerAnimal;

final class Zoo
{
    /**
     * @var Animal[]
     */
    public function __construct(
        private array $animals = []
    ) {
    }

    /**
     * Adds an animal to the zoo
     */
    public function addAnimal(Animal $animal): void
    {
        $this->animals[] = $animal;
    }

    /**
     * Returns all animals in the zoo
     * 
     * @return Animal[]
     */
    public function getAnimals(): array
    {
        return $this->animals;
    }

    /**
     * Feeds the animals with the given meal
     * If the animal can't eat the meal, it will be ignored
     */
    public function feedAnimals(MealEnum $meal): array
    {
        $animals = array_filter($this->animals, fn (Animal $animal) => $animal->canEat($meal));
        return array_map(
            fn (Animal $animal) => $animal->eat($meal),
            $animals
        );
    }

    /**
     * Grooms the animals that can be groomed, if they are FurBearerAnimal
     */
    public function groomAnimals(): array
    {
        $groomableAnimals = array_filter($this->animals, fn (Animal $animal) => $animal instanceof FurBearerAnimal);
        return array_map(
            fn (FurBearerAnimal $animal) => $animal->groom(),
            $groomableAnimals
        );
    }
}
