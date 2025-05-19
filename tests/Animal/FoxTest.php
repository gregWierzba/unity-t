<?php

declare(strict_types=1);

namespace UnitryT\Tests\Animal;

use PHPUnit\Framework\TestCase;
use UnitryT\Animal\Fox;
use UnitryT\Diet\MealEnum;

final class FoxTest extends TestCase
{
    public function testToString(): void
    {
        $fox = new Fox('Name');
        $this->assertEquals('Lis Name', $fox);
    }

    public function testCanEat(): void
    {
        $fox = new Fox('Name');
        $this->assertTrue($fox->canEat(MealEnum::MEAT));
        $this->assertTrue($fox->canEat(MealEnum::VEGETABLES));
    }

    public function testEat(): void
    {
        $fox = new Fox('Name');
        $this->assertEquals('Name eats mięso', $fox->eat(MealEnum::MEAT));
        $this->assertEquals('Name eats rośliny', $fox->eat(MealEnum::VEGETABLES));
    }

    public function testGroom(): void
    {
        $fox = new Fox('Name');
        $this->assertEquals('Name is being groomed', $fox->groom());
    }
}