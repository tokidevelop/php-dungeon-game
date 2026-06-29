# PHP Dungeon Game

## Features

* Turn-based dungeon game played in the command line.
* Randomly generated dungeon for every game.
* Configurable game settings, including:

    * Number of rooms.
    * Player hit points.
    * Monster hit points.
    * Monster damage.
    * Treasure value.
* Four movement directions:

    * North
    * South
    * East
    * West
* Rooms can contain:

    * Monsters
    * Treasure
    * Nothing
    * The exit
* Simple combat system where the player and monster attack until one is defeated.
* Treasure is automatically collected and added to the player's score.
* The game ends when:

    * The player dies.
    * The player reaches the exit.

---

## Technical Choices

This project focuses on clean, maintainable and object-oriented PHP rather than implementing a feature-rich game.

### Architecture

The application separates responsibilities into dedicated components:

* **Entity** – Represents the game state (`Player`, `Monster`, `Dungeon`, `Room`, `Treasure`).
* **Service** – Contains business logic (`CombatService`, `MovementService`, `RoomInteractionService`,
  `DirectionParser`).
* **Factory** – Responsible for creating objects (`GameFactory`, `DungeonFactory`).
* **Collection** – Strongly typed collections instead of passing arrays (`Rooms`).
* **DTO / Config** – Immutable configuration and result objects.
* **Enum** – Domain-specific enums such as directions and room content.
* **Exception** – Domain-specific exceptions for invalid states.

### Design Principles

The project follows several SOLID principles:

* **Single Responsibility Principle** by separating game logic, combat, rendering and dungeon generation.
* **Dependency Injection** through constructors.
* **Immutable configuration** using readonly objects.
* **Factories** to encapsulate object creation.
* **Collections** instead of raw arrays where appropriate.
* **Custom exceptions** for invalid domain situations instead of relying on PHP runtime errors.

---

## Configuration

The game can be configured from `play.php` by creating a `Config` instance.
Adjusting these values allows the difficulty and size of the dungeon to be customized without changing the game logic.

---

## Gameplay

1. The player starts in the entrance of a randomly generated dungeon.

2. Each turn, enter one of the available commands:

    * `north`
    * `south`
    * `east`
    * `west`

3. After moving, one of the following may happen:

    * Nothing happens.
    * A monster appears and combat starts automatically.
    * Treasure is found and collected automatically.
    * The exit is found.

4. Combat continues until either:

    * The monster dies.
    * The player dies.

5. The game finishes when:

    * The player reaches the exit.
    * The player has no remaining hit points.
