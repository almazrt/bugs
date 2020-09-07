<?php


namespace App;


class Bug
{
    protected ?Stone $stone;

    /**
     * Bug constructor.
     * @param Stone|null $stone
     */
    public function __construct(?Stone $stone = null)
    {
        $this->stone = $stone;
    }

    /**
     * @return Stone|null
     */
    public function getStone(): ?Stone
    {
        return $this->stone;
    }

    /**
     * @param Stone|null $stone
     * @return Stone|null
     */
    public function setStone(?Stone $stone): ?Stone
    {
        return $this->stone = $stone;
    }

}
