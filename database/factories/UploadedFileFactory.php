<?php

namespace Database\Factories;

use App\Models\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UploadedFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UploadedFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;

        return [
            'filename' => $name . '.jpg',
            'resized_filename' => $name . '_resized.jpg'
        ];
    }
}
