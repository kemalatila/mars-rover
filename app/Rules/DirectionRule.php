<?php

namespace App\Rules;

use App\Models\Plateau;
use Illuminate\Contracts\Validation\Rule;

class DirectionRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array($value, [
            Plateau::EAST,
            Plateau::NORTH,
            Plateau::SOUTH,
            Plateau::WEST,
        ]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The :attribute has invalid direction.';
    }
}
