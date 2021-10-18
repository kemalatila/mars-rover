<?php

namespace App\Http\Requests\Api\Rover;

use App\Models\Plateau;
use App\Rules\DirectionRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'plateau_id' => ['required', 'int'],
            'direction' => ['required', Rule::in(Plateau::NORTH, Plateau::EAST, Plateau::SOUTH, Plateau::WEST)],
            'coordinateX' => ['required', 'int', 'min:0'],
            'coordinateY' => ['required', 'int', 'min:0'],
        ];
    }
}
