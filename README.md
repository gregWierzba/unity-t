# Unity-t Exercise 1

## Requirements
- PHP 8.2 or higher
- Composer for dependency management

## Development Tools
The project uses several development tools to ensure code quality:
- PHPUnit for testing
- PHPStan for static analysis
- PHP CS Fixer for code style fixing

## Available Scripts
The following scripts are available in `composer.json`:

- `composer test`: Runs PHPUnit tests with colored output
- `composer analyse`: Performs static analysis using PHPStan
- `composer fix`: Fixes code style issues using PHP CS Fixer

## Project Structure
```mermaid
classDiagram
    class Zoo {
        +addAnimal(Animal $animal)
        +getAnimals()
    }
    
    class Animal {
        <<abstract>>
        +getName()
        +getSpecies()
        +getDiet()
    }
    
    class FurBearerAnimal {
        +getFurColor()
    }
    
    class Rabbit
    class Fox
    class SnowLeopard
    class Tiger
    class Elephant
    class Rhino
    
    class DietTypes {
        <<enum>>
        CARNIVORE
        HERBIVORE
        OMNIVORE
    }
    
    class MealEnum {
        <<enum>>
        MEAT
        PLANTS
        MIXED
    }
    
    Animal <|-- FurBearerAnimal
    FurBearerAnimal <|-- Fox
    FurBearerAnimal <|-- SnowLeopard
    FurBearerAnimal <|-- Tiger
    Animal <|-- Rabbit
    Animal <|-- Elephant
    Animal <|-- Rhino
    
    Animal --> DietTypes
    Animal --> MealEnum
    Zoo --> Animal

    style Zoo fill:#f9f,stroke:#333,stroke-width:2px
    style Animal fill:#bbf,stroke:#333,stroke-width:2px
    style FurBearerAnimal fill:#bfb,stroke:#333,stroke-width:2px
```

## Installation
```bash
composer install
```

## License
This project is licensed under the MIT License.

