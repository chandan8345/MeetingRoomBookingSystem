<?php

namespace Database\Factories;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DesignationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Designation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'designation_name' => $this->faker->randomElement(['Officer', 'Executive Officer','Senior Officer','AVP']),
            'des_creator_id' => User::all()->random()->id
        ];
    }
}
