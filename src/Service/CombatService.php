<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\CombatResult;
use App\Entity\Monster;
use App\Entity\Player;

use Random\RandomException;

use function sprintf;

final readonly class CombatService
{
    /**
     * @throws RandomException
     */
    public function fight(Player $player, Monster $monster): CombatResult
    {
        $log = 'A monster attacks!' . PHP_EOL;

        while ($player->isAlive() === true && $monster->isAlive() === true) {
            $damage = $player->attack();
            $monster->takeDamage($damage);

            $log .= sprintf('You strike for %d damage', $damage) . PHP_EOL;

            if ($monster->isAlive() === false) {
                $log .= 'The monster has been killed!' . PHP_EOL;
                break;
            }

            $damage = $monster->attack();
            $player->takeDamage($damage);

            $log .= sprintf('The monster strikes for %d damage', $damage) . PHP_EOL;
        }

        return new CombatResult($log);
    }
}
