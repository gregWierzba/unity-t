<?php

declare(strict_types=1);

namespace UnitryT\Animal;

/**
 * Species of the animal
 */
enum Species: string
{
    case ELEPHANT = 'Słoń';
    case TIGER = 'Tygrys';
    case FOX = 'Wilk';
    case RHINO = 'Rhinocerus';
    case SNOW_LEOPARD = 'Irbis śnieżny';
    case RABBIT = 'Królik';
}
