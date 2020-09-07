<?php

use App\SeatingManager;

require_once 'vendor/autoload.php';

function calc($x, $y)
{
    $seatingManager = new SeatingManager();
    $seatingManager->makeStones($x);
    $seatingManager->makeBugs($y);

    $stone = $seatingManager->getLastBug()->getStone();
    $prevFreeStonesCount = $stone->countPrevFreeStones();
    $nextFreeStonesCount = $stone->countNextFreeStones();

    echo "X={$x}, Y={$y} - ответ {$prevFreeStonesCount},{$nextFreeStonesCount}\n";
}

calc(8, 1);
calc(8, 2);
calc(8, 3);
