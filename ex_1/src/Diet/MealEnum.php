<?php

declare(strict_types=1);

namespace UnitryT\Diet;

/**
 * Meals of the animal
 *
 * Animal can eat only specific meals, so we can use this enum to check if the animal can eat a meal
 */
enum MealEnum: string
{
    case MEAT = 'mięso';
    case VEGETABLES = 'rośliny';
}
