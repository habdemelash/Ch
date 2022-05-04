<?php

namespace Database\Factories;
use App\Models\Event;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
         return [
            'title' => $this->faker->name(),
            'short_desc' => $this->faker->text(100),
            'location' => $this->faker->text(10),
            'details' => $this->faker->text(500),
            'due_date' => $this->faker->numberBetween(2021,2023).'-'.$this->faker->numberBetween(1,12).'-'.$this->faker->numberBetween(1,31),
            'status' => 'Upcoming',
            'start_time'=>$this->faker->numberBetween(0,23).':'. $this->faker->numberBetween(0,59),
            'end_time'=>$this->faker->numberBetween(0,23).':'. $this->faker->numberBetween(0,59),
            'needed_vols'=>$this->faker->numberBetween(1,300),
            
            
        ];
    }
}
