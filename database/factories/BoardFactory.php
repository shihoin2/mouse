<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Board>
 */
class BoardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'boards_name' => fake()->text(15),
            'user_id' => 1,
            'tpl_id' => 1,
            'edited_html' => fake()->randomHtml(),
            'board_thumbnail' => 'http://localhost/storage/sample.jpg',
        ];
    }
}