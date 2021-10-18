<?php

namespace App\Models;

class Plateau extends BaseRedisModel
{
    const NORTH = 'N';
    const WEST = 'W';
    const EAST = 'E';
    const SOUTH = 'S';

    private $maxX;
    private $maxY;
    protected $modelName = 'Plateau';


    /**
     * @param $maxX
     * @param $maxY
     */
    public function __construct(int $maxX, int $maxY)
    {
        $this->id = rand(0, 1000);
        $this->maxX = $maxX;
        $this->maxY = $maxY;
    }

    /**
     *
     * @return int
     */
    public function getMaxYCoordinate(): int
    {
        return $this->maxY;
    }

    /**
     *
     * @return int
     */
    public function getMaxXCoordinate(): int
    {
        return $this->maxX;
    }
}
