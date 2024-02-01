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
    protected $model = Template::class;

    public function definition(): array
    {
        return [
            'tpl_name' => fake()->text(15),
            'html' => $this->faker->randomHtml(),
            'thumbnail' => fake()->imageUrl(),
        ];
    }
}
