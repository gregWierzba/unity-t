<?php declare(strict_types=1);

namespace UnitryT\Tests\Animal;

use PHPUnit\Framework\TestCase;
use UnitryT\Animal\Tiger;
use UnitryT\Diet\MealEnum;
use Exception;

final class TigerTest extends TestCase
{
public function testToString(): void
 {
     $tiger = new Tiger('Tiger');
    // "Tygrys" is the Polish translation from Species::TIGER->value
     $this->assertEquals('Tygrys Tiger', $tiger);
 }

    public function testCanEat(): void
    {
        $tiger = new Tiger('Tiger');
        $this->assertTrue($tiger->canEat(MealEnum::MEAT));
        $this->assertFalse($tiger->canEat(MealEnum::VEGETABLES));
    }

    public function testEat(): void
    {
        $tiger = new Tiger('Tiger');
        $this->assertEquals(
        'Tiger eats ' . MealEnum::MEAT->value,
        $tiger->eat(MealEnum::MEAT)
    );
    }

    public function testCannotEat(): void
    {
        $tiger = new Tiger('Tiger');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(
            sprintf('%s cannot eat %s', 'Tiger', MealEnum::VEGETABLES->value)
        );
        $tiger->eat(MealEnum::VEGETABLES);
    }

    public function testGroom(): void
    {
        $tiger = new Tiger('Tiger');
        $this->assertEquals('Tiger is being groomed', $tiger->groom());
    }
}