<?php

namespace App\Http\Resources\Api;

use App\Model\Rover;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Rover
 */
class RoverStateResource extends JsonResource
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
            'id' => $this->getId(),
            'plateau_id' => $this->getPlateauId(),
            'direction' => $this->getDirection(),
            'coordinates' => $this->getCurrentCoordinates()
        ];
    }
}
