<?php


namespace App;


class Stone
{
    protected ?Bug $bug = null;
    protected ?Stone $prevStone = null;
    protected ?Stone $nextStone = null;

    /**
     * @return Bug
     */
    public function getBug(): ?Bug
    {
        return $this->bug;
    }

    /**
     * @param Bug|null $bug
     */
    public function setBug(?Bug $bug): void
    {
        $this->bug = $bug;
    }

    /**
     * @return Stone|null
     */
    public function getPrevStone(): ?Stone
    {
        return $this->prevStone;
    }

    /**
     * @param Stone|null $prevStone
     */
    public function setPrevStone(?Stone $prevStone): void
    {
        $this->prevStone = $prevStone;
    }

    /**
     * @return Stone|null
     */
    public function getNextStone(): ?Stone
    {
        return $this->nextStone;
    }

    /**
     * @param Stone|null $nextStone
     */
    public function setNextStone(?Stone $nextStone): void
    {
        $this->nextStone = $nextStone;
    }

    /**
     * @return bool
     */
    public function isBusy(): bool
    {
        return !!$this->bug;
    }

    /**
     * @return bool
     */
    public function isFree(): bool
    {
        return !$this->bug;
    }

    /**
     * @return int
     */
    public function countPrevFreeStones(): int
    {
        $count = 0;
        $stone = $this->getPrevStone();
        while ($stone && $stone->isFree()) {
            $stone = $stone->getPrevStone();
            $count++;
        }
        return $count;
    }

    /**
     * @return int
     */
    public function countNextFreeStones(): int
    {
        $count = 0;
        $stone = $this->getNextStone();
        while ($stone && $stone->isFree()) {
            $stone = $stone->getNextStone();
            $count++;
        }
        return $count;
    }

    /**
     * @param int $order
     * @return Stone
     */
    public function getPrevStoneByOrder(int $order): Stone
    {
        $stone = $this;
        for ($i = 1; $i <= $order; $i++) {
            $stone = $stone->getPrevStone();
        }
        return $stone;
    }

    /**
     * @param int $order
     * @return Stone
     */
    public function getNextStoneByOrder(int $order): Stone
    {
        $stone = $this;
        for ($i = 1; $i <= $order; $i++) {
            $stone = $stone->getNextStone();
        }
        return $stone;
    }


}
