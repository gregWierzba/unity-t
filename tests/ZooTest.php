<?php declare(strict_types=1);

namespace UnitryT\Tests;

use UnitryT\Zoo;
use UnitryT\Animal\Tiger;
use UnitryT\Diet\MealEnum;
use PHPUnit\Framework\TestCase;
use UnitryT\Animal\Elephant;
use UnitryT\Animal\Fox;

final class ZooTest extends TestCase
{
    public function testAddAnimal(): void
    {
        $zoo = new Zoo([]);
        $zoo->addAnimal(new Tiger('Name'));

        $this->assertCount(1, $zoo->getAnimals());
        $this->assertEquals(new Tiger('Name'), $zoo->getAnimals()[0]);

        $zoo->addAnimal(new Tiger('Name2'));

        $this->assertCount(2, $zoo->getAnimals());
        $this->assertEquals(new Tiger('Name2'), $zoo->getAnimals()[1]);
    }

    public function testFeedAnimals(): void
    {
        $zoo = new Zoo([]);
        $zoo->addAnimal(new Tiger('Name'));
        $zoo->addAnimal(new Tiger('Name2'));

        $this->assertEquals(['Name eats mięso', 'Name2 eats mięso'], $zoo->feedAnimals(MealEnum::MEAT));
    }

    public function testFeedCarnivoreAnimalsWithVegetables(): void
    {
        $zoo = new Zoo([]);
        $zoo->addAnimal(new Tiger('Name'));
        $zoo->addAnimal(new Tiger('Name2'));

        $this->assertEquals([], $zoo->feedAnimals(MealEnum::VEGETABLES));
    }

    public function testFeedHerbivoreAnimalsWithMeat(): void
    {
        $zoo = new Zoo([]);
        $zoo->addAnimal(new Elephant('Name'));
        $zoo->addAnimal(new Elephant('Name2'));

        $this->assertEquals([], $zoo->feedAnimals(MealEnum::MEAT));
    }

    public function testFeedOmnivoreAnimalsWithMeatAndVegetables(): void
    {
        $zoo = new Zoo([]);
        $zoo->addAnimal(new Fox('Name'));
        $zoo->addAnimal(new Fox('Name2'));

        $this->assertEquals(['Name eats mięso', 'Name2 eats mięso'], $zoo->feedAnimals(MealEnum::MEAT));
        $this->assertEquals(['Name eats rośliny', 'Name2 eats rośliny'], $zoo->feedAnimals(MealEnum::VEGETABLES));
    }

    public function testGroomAnimals(): void
    {
        $zoo = new Zoo([]);
        $zoo->addAnimal(new Fox('Name'));
        $zoo->addAnimal(new Elephant('Name2'));
        $zoo->addAnimal(new Tiger('Name3'));

        $this->assertEquals(['Name is being groomed', 'Name3 is being groomed'], $zoo->groomAnimals());
    }
}
