<?php

namespace Taskday\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Taskday\Models\Comment;
use Taskday\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Taskday\Models\Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
        ];
    }
}
