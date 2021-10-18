<?php

namespace App\Models;

use Exception;

class Rover extends BaseRedisModel
{
    const COMMAND_MOVE = 'M';
    const COMMAND_LEFT = 'L';
    const COMMAND_RIGHT = 'R';

    /**
     * @var string
     */
    protected string $plateauId;

    /**
     * @var string
     */
    protected string $direction;
    /**
     * @var
     */
    private $coordinateX;
    /**
     * @var
     */
    private $coordinateY;

    private BaseRedisModel $plateau;


    /**
     * @param int $plateauId
     * @param string $direction
     * @param $coordinateX
     * @param $coordinateY
     */
    public function __construct(string $plateauId, string $direction, $coordinateX, $coordinateY)
    {
        $this->id = rand(0, 1000);
        $this->plateauId = $plateauId;
        $this->direction = $direction;
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
        $this->plateau = Plateau::findOrFail($this->plateauId);

        return $this->checkRoverCanPlaced($this->plateau, $coordinateX, $coordinateY);
    }

    /**
     * Get x Coordinate
     *
     * @return int
     */
    public function getXCor(): int
    {
        return $this->coordinateX;
    }

    /**
     * Get y coordinate.
     *
     * @return int
     */
    public function getYCor(): int
    {
        return $this->coordinateY;
    }

    /**
     * Get the rover's plateau id.
     *
     * @return int
     */
    public function getPlateauId(): int
    {
        return $this->plateauId;
    }

    /**
     * @return array
     */
    public function getCurrentCoordinates()
    {
        return [
            'coordinateX' => $this->coordinateX,
            'coordinateY' => $this->coordinateY
        ];
    }

    /**
     * @param $coordinateX
     * @param $coordinateY
     */
    public function setCurrentCoordinates($coordinateX, $coordinateY): void
    {
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    public function getPlateau(): BaseRedisModel
    {
        return $this->plateau;
    }

    /**
     * @param string $direction
     */
    public function setDirection(string $direction): void
    {
        $this->direction = $direction;
    }



    /**
     * @param BaseRedisModel $plateau
     * @param $coordinateX
     * @param $coordinateY
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function checkRoverCanPlaced(BaseRedisModel $plateau, $coordinateX, $coordinateY)
    {
        if ($coordinateX > $plateau->getMaxXCoordinate() || $coordinateY > $plateau->getMaxYCoordinate()) {
            throw new Exception('Rover cannot be deployed at this coordinate');
        }
    }

    public function throwCannotBeDeployed(): void
    {
        throw new Exception('Rover cannot be deployed at this coordinate');
    }
}
