<?php

namespace App\Http\Controllers\v1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Plateau\StoreRequest;
use App\Http\Resources\Api\PlateauResource;
use App\Models\Plateau;
use Exception;

class PlateauController extends Controller
{
    /**
     * Store new plateau
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse|object
     * @throws Exception
     */
    public function store(StoreRequest $request)
    {
        $width = $request->input('width');
        $height = $request->input('height');

        $plateau = new Plateau($width, $height);
        $plateau->save();

        return (new PlateauResource($plateau))
            ->response()
            ->setStatusCode(201);
    }

    /**
     *
     * @param string $id
     * @return PlateauResource
     */
    public function show(string $uid): PlateauResource
    {
        $plateau = Plateau::find($uid);
        if (!$plateau) {
            abort(404);
        }

        return new PlateauResource($plateau);
    }
}
