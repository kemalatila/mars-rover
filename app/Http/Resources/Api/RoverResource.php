<?php

namespace App\Http\Resources\Api;

use App\MemoryModels\Rover;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Rover
 */
class RoverResource extends JsonResource
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
        ];
    }
}
