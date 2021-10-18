<?php

namespace Tests\Unit\Models;

use App\Models\Plateau;
use App\Models\Rover;
use App\Repositories\RoverRepository;
use Exception;
use Tests\TestCase;

class RoverRepositoryTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function test_turn_left()
    {
        $x = random_int(1, 100);
        $y = random_int(1, 100);

        $plateau = new Plateau($x, $y);
        $plateau->save();

        $rover = new Rover($plateau->getId(), 'S', $x, $y);
        $rover->save();

        $roverRepo = new RoverRepository($rover);
        $roverRepo->turn('L');


        $this->assertSame($rover->find($rover->getId())->getDirection(), 'E');

    }

//    public function test_turn_right()
//    {
//
//    }
//
//    public function test_turn_move()
//    {
//
//    }
}
