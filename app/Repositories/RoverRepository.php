<?php

namespace App\Repositories;

use App\Models\Plateau;
use App\Models\Rover;
use Exception;

class RoverRepository
{

    public function __construct(Rover $model)
    {
        $this->model = $model;
    }

    public function moveForward()
    {
        $maxXCor = $this->model->getPlateau()->getMaxXCoordinate();
        $maxYCor = $this->model->getPlateau()->getMaxYCoordinate();
        $facade = $this->model->getDirection();

        $corX = $this->model->getXCor();
        $corY = $this->model->getYCor();

        if ($facade == Plateau::EAST) {
            $corX = $corX + 1;
        }

        if ($facade == Plateau::NORTH) {
            $corY = $corY + 1;
        }

        if ($facade == Plateau::WEST) {
            $corX = $corX - 1;
        }

        if ($facade == Plateau::SOUTH) {
            $corY = $corY - 1;
        }

        $this->checkRoverCanPlaced($maxYCor, $corY, $maxXCor, $corX);

        $this->model->setCurrentCoordinates($corX, $corY);
    }

    /**
     * @param string $direction
     * @return string
     */
    public function turn(string $direction)
    {
        $facade = $this->model->getDirection();
        if ($direction == 'R') {
            $newFacede = match ($facade) {
                Plateau::NORTH => Plateau::EAST,
                Plateau::EAST => Plateau::SOUTH,
                Plateau::SOUTH => Plateau::WEST,
                Plateau::WEST => Plateau::NORTH,
            };
            $this->model->setDirection($newFacede);
        }

        if ($direction == 'L') {
            $newFacade = match ($facade) {
                Plateau::NORTH => Plateau::WEST,
                Plateau::EAST => Plateau::NORTH,
                Plateau::SOUTH => Plateau::EAST,
                Plateau::WEST => Plateau::SOUTH
            };
            $this->model->setDirection($newFacade);
        }
    }

    public function cannotDeployed(): void
    {
        throw new Exception('Rover cannot be deployed at this coordinate');
    }

    /**
     * @param $maxYCor
     * @param int $corY
     * @param $maxXCor
     * @param int $corX
     * @throws Exception
     */
    public function checkRoverCanPlaced($maxYCor, int $corY, $maxXCor, int $corX): void
    {
        if ($maxYCor < $corY) {
            $this->cannotDeployed();
        }
        if ($maxXCor < $corX) {
            $this->cannotDeployed();
        }
    }
}
