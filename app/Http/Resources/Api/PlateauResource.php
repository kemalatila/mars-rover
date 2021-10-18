<?php

namespace App\Http\Resources\Api;

use App\Models\Plateau;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Plateau
 */
class PlateauResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'plateauId' => $this->getId(),
            'maxXCoordinate' => $this->getMaxXCoordinate(),
            'maxYCoordinate' => $this->getMaxYCoordinate(),
        ];
    }
}
