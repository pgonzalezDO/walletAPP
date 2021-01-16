<?php

namespace Database\Factories;

use App\Models\Transfer;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transfer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text($maxNbChars = 200),
            'amount' => $this->faker->numberBetween($min = 10, $max = 50),
            'wallet_id' => $this->faker->randomDigitNotNull
        ];
    }
}
