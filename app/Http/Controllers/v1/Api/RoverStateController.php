<?php

namespace App\Http\Controllers\v1\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\RoverStateResource;
use App\Models\Rover;

class RoverStateController extends Controller
{
    /**
     * @param int $id
     * @return RoverStateResource
     */
    public function show(int $id): RoverStateResource
    {
        $rover = Rover::findOrFail($id);

        return new RoverStateResource($rover);
    }
}
