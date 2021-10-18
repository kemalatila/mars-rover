<?php

namespace Tests\Unit\Models;

use App\Models\Plateau;
use App\Models\Rover;
use Exception;
use Tests\TestCase;

class RoverTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_can_create_and_save()
    {
        $direction = 'S';
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        $plateau = new Plateau($x, $y);
        $plateau->save();

        $rover = new Rover($plateau->getId(), $direction, $x, $y);
        $rover->save();

        /** @var Rover $findRover */
        $findRover = Rover::find($rover->getId());

        $this->assertSame(
            $rover->getId(),
            $findRover->getId(),
        );

        $this->assertSame(
            $rover->getPlateauId(),
            $findRover->getPlateauId(),
        );

        $this->assertSame(
            $rover->getXCor(),
            $findRover->getXCor(),
        );

        $this->assertSame(
            $rover->getYCor(),
            $findRover->getYCor(),
        );

        $this->assertSame(
            $rover->getDirection(),
            $findRover->getDirection(),
        );
    }
}
