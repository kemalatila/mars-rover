<?php

namespace App\Http\Controllers\v1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rover\CommandRequest;
use App\Http\Resources\Api\RoverStateResource;
use App\Models\Rover;
use App\Repositories\RoverRepository;
use Exception;

class RoverCommandController extends Controller
{
    /**
     * @param int $id
     * @param CommandRequest $request
     * @return RoverStateResource
     * @throws Exception
     */
    public function commandReceiver(int $id, CommandRequest $request): RoverStateResource
    {
        /** @var Rover $rover */
        $rover = Rover::findOrFail($id);

        $roverRepo = new RoverRepository($rover);

        $commands = str_split($request->input('commands'));

        foreach ($commands as $command) {
            if ($command == Rover::COMMAND_MOVE) {
                $roverRepo->moveForward();
            }

            if ($command == Rover::COMMAND_LEFT || $command == Rover::COMMAND_RIGHT) {
                $roverRepo->turn($command);
            }
        }

        // Save the rover state
        $rover->save();

        return new RoverStateResource($rover);
    }
}
