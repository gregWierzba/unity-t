<?php declare(strict_types=1);

namespace UnitryT\Tests;

use UnitryT\Zoo;
use UnitryT\Animal\Tiger;
use UnitryT\Diet\MealEnum;
use PHPUnit\Framework\TestCase;
use UnitryT\Animal\Elephant;
use UnitryT\Animal\Fox;
use InvalidArgumentException;
use stdClass;
use PHPUnit\Framework\Attributes\DataProvider;

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
     * Test constructor with invalid animals
     */
    public function testConstructorWithInvalidAnimals(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->zoo = new Zoo([new Tiger('Name'), new stdClass()]);
    }

    /**
     * Animal provider
     */
    public static function provideAnimalData(): array
    {
        return [
            'carnivores with meat' => [
                [new Tiger('Name'), new Tiger('Name2')],
                MealEnum::MEAT,
                ['Name eats mięso', 'Name2 eats mięso']
            ],
            'carnivores with vegetables' => [
                [new Tiger('Name'), new Tiger('Name2')],
                MealEnum::VEGETABLES,
                []
            ],
            'herbivores with meat' => [
                [new Elephant('Name'), new Elephant('Name2')],
                MealEnum::MEAT,
                []
            ],
            'omnivores with meat' => [
                [new Fox('Name'), new Fox('Name2')],
                MealEnum::MEAT,
                ['Name eats mięso', 'Name2 eats mięso']
            ],
            'omnivores with vegetables' => [
                [new Fox('Name'), new Fox('Name2')],
                MealEnum::VEGETABLES,
                ['Name eats rośliny', 'Name2 eats rośliny']
            ],
            'mixed animals' => [
                [new Tiger('Name'), new Fox('Name2'), new Elephant('Name3')],
                MealEnum::MEAT,
                ['Name eats mięso', 'Name2 eats mięso']
            ],
            'mixed animals with vegetables' => [
                [new Tiger('Name'), new Fox('Name2'), new Elephant('Name3')],
                MealEnum::VEGETABLES,
                ['Name2 eats rośliny', 'Name3 eats rośliny']
            ]
        ];
    }

    /**
     * Test feeding animals with a given meal
     */
     #[DataProvider('provideAnimalData')]
    public function testFeedAnimals(array $animals, MealEnum $meal, array $expected): void
    {
        foreach ($animals as $animal) {
            $this->zoo->addAnimal($animal);
        }

        // Use array_values to reset array keys for consistent comparison
        $this->assertEquals(array_values($expected), array_values($this->zoo->feedAnimals($meal)));
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
