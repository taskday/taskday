<?php

namespace Taskday\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Taskday\Models\Board;
use Taskday\Models\Field;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Taskday\Models\Field>
 */
class FieldFactory extends Factory
{
    protected $model = Field::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'type' => fake()->name(),
            'board_id' => Board::factory(),
        ];
    }
}
