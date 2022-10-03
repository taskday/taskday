<?php

namespace Taskday\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use Taskday\Models\Board;
use Taskday\Models\Category;
use Taskday\Models\User;

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
            'user_id' => User::factory(),
            'category_id' => Category::factory()
        ];
    }

    public function owned()
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => Auth::id(),
        ]);
    }
}
