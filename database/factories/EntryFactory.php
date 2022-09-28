<?php

namespace Taskday\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Taskday\Models\Entry;
use Taskday\Models\User;
use Illuminate\Support\Facades\Auth;
use Taskday\Models\Board;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Taskday\Models\Entry>
 */
class EntryFactory extends Factory
{
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'user_id' => User::factory(),
            'board_id' => Board::factory(),
        ];
    }

    public function owned()
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => Auth::id(),
        ]);
    }
}
