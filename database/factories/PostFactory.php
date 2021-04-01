<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Room;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'purpose' => $this->faker->text,
            'meetingdate' => $this->faker->dateTimeBetween('-05 days', '+05 days'),
            'starttime' => $this->faker->time,
            'endtime' => $this->faker->time,
            'meetingtype' => $this->faker->randomElement(['Internal', 'External']),
            'total' => rand(1,10),
            'postingdate' => $this->faker->date,
            'room' => Room::all()->random()->name,
            'category' => Category::all()->random()->name,
            'postuser_id' => Category::all()->random()->id,
            'room_id' => Room::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'status' => $this->faker->randomElement(['booked', 'postponed']),
        ];
    }
}
