<?php

namespace Database\Factories;

use App\Models\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

class StorageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Storage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company;
        return [
            //
            'name' => $name,
            'slug' => \Str::slug($name,"-"),
            'description' => $this->faker->sentence,
            'sku' => $this->faker->numberBetween( 10, 900),
            'mm' => $this->faker->fileExtension,
            'price' => $this->faker->numberBetween( 10, 900)
        ];
    }
}
