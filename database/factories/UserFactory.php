<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'room_booking_role' => $this->faker->randomElement(['admin','user']),
            'password' => Hash::make('Glil@321'), // password
            'remember_token' => Str::random(10),
            'department_id' =>  rand(1,4),
            'designation_id' => rand(1,4)
        ];
    }
}
