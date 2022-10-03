<?php

namespace Taskday\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Taskday\Models\Category;
use Taskday\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Taskday\Models\Board>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

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
        ];
    }
}
