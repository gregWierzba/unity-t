<?php

declare(strict_types=1);

namespace UnitryT;

use UnitryT\Animal\Animal;
use UnitryT\Diet\MealEnum;
use UnitryT\Animal\FurBearerAnimal;

final class Zoo
{
    /**
     * @param Animal[] $animals
     */
    public function __construct(
        private array $animals = []
    ) {
        foreach ($this->animals as $animal) {
            if (!$animal instanceof Animal) {
                throw new \InvalidArgumentException('All elements must be instances of Animal');
            }
        }
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
     *
     * @return string[] Array of messages describing what each animal ate
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
     *
     * @return string[] Array of messages describing what each animal was groomed
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
