<?php

declare(strict_types=1);

namespace UnitryT\Tests\Animal;

use PHPUnit\Framework\TestCase;
use UnitryT\Animal\Elephant;
use UnitryT\Diet\MealEnum;
use Exception;

final class ElephantTest extends TestCase
{
    public function testToString(): void
    {
        $elephant = new Elephant('Name');
        $this->assertEquals('Słoń Name', $elephant);
    }

    public function testCanEat(): void
    {
        $elephant = new Elephant('Name');
        $this->assertTrue($elephant->canEat(MealEnum::VEGETABLES));
        $this->assertFalse($elephant->canEat(MealEnum::MEAT));
    }

    public function testEat(): void
    {
        $elephant = new Elephant('Name');
        $this->assertEquals('Name eats rośliny', $elephant->eat(MealEnum::VEGETABLES));
    }

    public function testCannotEat(): void
    {
        $elephant = new Elephant('Name');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            sprintf('%s cannot eat %s', 'Name', MealEnum::MEAT->value)
        );
        $elephant->eat(MealEnum::MEAT);
    }

    public function testGroom(): void
    {
        $elephant = new Elephant('Name');
        $this->expectException(\Error::class);
        $elephant->groom();
    }
}