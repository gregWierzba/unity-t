<?php

declare(strict_types=1);

namespace UnitryT\Diet;

/**
 * Diet types of the animal
 */
enum DietTypes: string
{
    case CARNIVORE = 'mięsożerne';
    case HERBIVORE = 'roślinożerne';
    case OMNIVORE = 'wszystkożerne';

    /**
     * Returns the meals that the animal can eat
     */
    public function meals(): array
    {
        return match ($this) {
            self::CARNIVORE => [MealEnum::MEAT],
            self::HERBIVORE => [MealEnum::VEGETABLES],
            self::OMNIVORE => [MealEnum::MEAT, MealEnum::VEGETABLES],
        };
    }
}
