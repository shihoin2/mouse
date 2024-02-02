<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Template;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Template>
 */
class TemplateFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
    public function definition(): array
    {
        return [
        'tpl_name' => fake()->text(15),
        'html' => fake()->text(150),
        'thumbnail' => "http://localhost/storage/sample.jpg"
        ];
    }
}