<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dep_name' => $this->faker->randomElement(['Claims', 'IT','Underwriting','Marketing']),
            'hod_id' => User::all()->random()->id,
            'dep_creator_id' => User::all()->random()->id
        ];
    }
}
