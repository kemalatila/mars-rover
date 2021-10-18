<?php

namespace App\Http\Controllers\v1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Rover\StoreRequest;
use App\Http\Resources\Api\RoverResource;
use App\Models\Rover;

class RoverController extends Controller
{
    /**
     * Store  rover.
     */
    public function store(StoreRequest $request)
    {
        try {
            $rover = new Rover(
                $request->input('plateau_id'),
                $request->input('direction'),
                $request->input('coordinateX'),
                $request->input('coordinateY')
            );

            $rover->save();

            return (new RoverResource($rover))
                ->response()
                ->setStatusCode(201);

        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage(), 401]);
        }
    }

    /**
     * Show rover by id.
     *
     * @param string $id
     * @return RoverResource
     */
    public function show(string $id): RoverResource
    {
        if (!$rover = Rover::find($id)) {
            return response()->json(['success' => false], 404);
        }

        return new RoverResource($rover);
    }
}
