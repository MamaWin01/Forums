<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'thread_id' => Thread::factory(),
            'body' => $this->faker->paragraph(2)
        ];
    }
}
