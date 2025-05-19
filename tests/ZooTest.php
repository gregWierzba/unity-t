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
    private Zoo $zoo;

    protected function setUp(): void
    {
        $this->zoo = new Zoo([]);
    }

    /**
     * Test adding an animal to the zoo
     */
    public function testAddAnimal(): void
    {
        $this->zoo->addAnimal(new Tiger('Name'));

        $this->assertCount(1, $this->zoo->getAnimals());
        $this->assertEquals(new Tiger('Name'), $this->zoo->getAnimals()[0]);

        $this->zoo->addAnimal(new Tiger('Name2'));

        $this->assertCount(2, $this->zoo->getAnimals());
        $this->assertEquals(new Tiger('Name2'), $this->zoo->getAnimals()[1]);
    }

    /**
     * Test constructor with animals
     */
    public function testConstructorWithAnimals(): void
    {
        $animals = [new Tiger('Name'), new Fox('Name2')];
        $this->zoo = new Zoo($animals);

        $this->assertCount(2, $this->zoo->getAnimals());
        $this->assertEquals($animals, $this->zoo->getAnimals());
    }

    /**
     * Test feeding animals
     */
    public function testFeedAnimals(): void
    {
        $this->zoo->addAnimal(new Tiger('Name'));
        $this->zoo->addAnimal(new Tiger('Name2'));

        $this->assertEquals(['Name eats mięso', 'Name2 eats mięso'], $this->zoo->feedAnimals(MealEnum::MEAT));
    }

    /**
     * Test feeding carnivore animals with vegetables
     */
    public function testFeedCarnivoreAnimalsWithVegetables(): void
    {
        $this->zoo->addAnimal(new Tiger('Name'));
        $this->zoo->addAnimal(new Tiger('Name2'));

        $this->assertEquals([], $this->zoo->feedAnimals(MealEnum::VEGETABLES));
    }

    /**
     * Test feeding herbivore animals with meat
     */
    public function testFeedHerbivoreAnimalsWithMeat(): void
    {
        $this->zoo->addAnimal(new Elephant('Name'));
        $this->zoo->addAnimal(new Elephant('Name2'));

        $this->assertEquals([], $this->zoo->feedAnimals(MealEnum::MEAT));
    }

    /**
     * Test feeding omnivore animals with meat and vegetables
     */
    public function testFeedOmnivoreAnimalsWithMeatAndVegetables(): void
    {
        $this->zoo->addAnimal(new Fox('Name'));
        $this->zoo->addAnimal(new Fox('Name2'));

        $this->assertEquals(['Name eats mięso', 'Name2 eats mięso'], $this->zoo->feedAnimals(MealEnum::MEAT));
        $this->assertEquals(['Name eats rośliny', 'Name2 eats rośliny'], $this->zoo->feedAnimals(MealEnum::VEGETABLES));
    }

    /**
     * Test grooming animals
     */
    public function testGroomAnimals(): void
    {
        $this->zoo->addAnimal(new Fox('Name'));
        $this->zoo->addAnimal(new Elephant('Name2'));
        $this->zoo->addAnimal(new Tiger('Name3'));

        $this->assertEquals(
            array_values(['Name is being groomed', 'Name3 is being groomed']),
            array_values($this->zoo->groomAnimals())
        );
    }
}
