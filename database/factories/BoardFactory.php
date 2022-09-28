<?php

namespace Taskday\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Taskday\Models\Board;
use Taskday\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Taskday\Models\Board>
 */
class BoardFactory extends Factory
{
    protected $model = Board::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'category_id' => Category::factory()
        ];
    }
}
