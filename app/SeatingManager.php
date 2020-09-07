<?php


namespace App;


class SeatingManager
{
    /**
     * @var Stone[]
     */
    protected array $stones = [];
    /**
     * @var Bug[]
     */
    protected array $bugs = [];

    /**
     * @return Stone[]
     */
    public function getStones(): array
    {
        return $this->stones;
    }

    /**
     * @param Stone[] $stones
     */
    public function setStones(array $stones): void
    {
        $this->stones = $stones;
    }

    /**
     * @return Bug[]
     */
    public function getBugs(): array
    {
        return $this->bugs;
    }

    /**
     * @param Bug[] $bugs
     */
    public function setBugs(array $bugs): void
    {
        $this->bugs = $bugs;
    }

    /**
     * @return int
     */
    public function countStones(): int
    {
        return count($this->stones);
    }

    /**
     * @return int
     */
    public function countBugs(): int
    {
        return count($this->bugs);
    }

    /**
     * @return Stone|null
     */
    public function getLastStone(): ?Stone
    {
        $count = $this->countStones();
        return $count > 0 ? $this->stones[$this->countStones() - 1] : null;
    }

    /**
     * @return Bug|null
     */
    public function getLastBug(): ?Bug
    {
        $count = $this->countBugs();
        return $count > 0 ? $this->bugs[$count - 1] : null;
    }

    /**
     * @param Stone $stone
     * @return Stone
     */
    public function addStone(Stone $stone): Stone
    {
        if ($lastStone = $this->getLastStone()) {
            $lastStone->setNextStone($stone);
            $stone->setPrevStone($lastStone);
        }
        $stone->setNextStone(null);
        array_push($this->stones, $stone);
        return $stone;
    }

    /**
     * @return Stone
     */
    public function makeStone(): Stone
    {
        $stone = new Stone();
        return $this->addStone($stone);
    }

    /**
     * @param int $amount
     */
    public function makeStones(int $amount): void
    {
        for ($i = 1; $i <= $amount; $i++) {
            $this->makeStone();
        }
    }

    /**
     * @return Stone|null
     */
    public function getFreerStone(): ?Stone
    {
        $countBugs = $this->countBugs();
        if ($countBugs === 0) {
            $countStones = $this->countStones();
            $index = floor($countStones / 2) - 1;
            return $this->stones[$index];
        }

        $prevFreerBug = $this->bugs[0];
        $nextFreerBug = $this->bugs[0];
        $maxPrevFreeStonesCount = 0;
        $maxNextFreeStonesCount = 0;

        foreach ($this->bugs as $bug) {
            $prevFreeStonesCount = $bug->getStone()->countPrevFreeStones();
            $nextFreeStonesCount = $bug->getStone()->countNextFreeStones();

            if ($prevFreeStonesCount > $maxPrevFreeStonesCount) {
                $maxPrevFreeStonesCount = $prevFreeStonesCount;
                $prevFreerBug = $bug;
            }
            if ($nextFreeStonesCount > $maxNextFreeStonesCount) {
                $maxNextFreeStonesCount = $nextFreeStonesCount;
                $nextFreerBug = $bug;
            }
        }

        if ($maxPrevFreeStonesCount === 0 && $maxNextFreeStonesCount === 0) return null;

        return $maxPrevFreeStonesCount >= $maxNextFreeStonesCount ?
            $prevFreerBug->getStone()->getPrevStoneByOrder(floor($maxPrevFreeStonesCount / 2) + 1) :
            $nextFreerBug->getStone()->getNextStoneByOrder(floor($maxNextFreeStonesCount / 2) + 1);
    }

    /**
     * @param Bug $bug
     * @return Bug
     * @throws \Exception
     */
    public function addBug(Bug $bug): Bug
    {
        $stone = $this->getFreerStone();

        if ($stone === null) {
            throw new \Exception('No free stones');
        }

        $bug->setStone($stone);
        $stone->setBug($bug);
        array_push($this->bugs, $bug);
        return $bug;
    }

    /**
     * @return Bug
     * @throws \Exception
     */
    public function makeBug(): Bug
    {
        $bug = new Bug();
        return $this->addBug($bug);
    }

    /**
     * @param int $amount
     * @throws \Exception
     */
    public function makeBugs(int $amount): void
    {
        for ($i = 1; $i <= $amount; $i++) {
            $this->makeBug();
        }
    }

}
