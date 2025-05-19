<?php declare(strict_types=1);

namespace UnitryT\Tests\Animal;

use PHPUnit\Framework\TestCase;
use UnitryT\Animal\Tiger;
use UnitryT\Diet\MealEnum;
use InvalidArgumentException;

final class TigerTest extends TestCase
{
    public function testToString(): void
    {
        $tiger = new Tiger('Name');
        $this->assertEquals('Tygrys Name', $tiger);
    }

    public function testCanEat(): void
    {
        $tiger = new Tiger('Name');
        $this->assertTrue($tiger->canEat(MealEnum::MEAT));
        $this->assertFalse($tiger->canEat(MealEnum::VEGETABLES));
    }

    public function testEat(): void
    {
        $tiger = new Tiger('Name');
        $this->assertEquals(
        'Name eats ' . MealEnum::MEAT->value,
        $tiger->eat(MealEnum::MEAT)
    );
    }

    public function testCannotEat(): void
    {
        $tiger = new Tiger('Name');
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('%s cannot eat %s', 'Name', MealEnum::VEGETABLES->value)
        );
        $tiger->eat(MealEnum::VEGETABLES);
    }

    public function testGroom(): void
    {
        $tiger = new Tiger('Name');
        $this->assertEquals('Name is being groomed', $tiger->groom());
    }
}