<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company, // Random company name
            'address' => $this->faker->address, // Random address
            'email' => $this->faker->unique()->safeEmail, // Random unique email
        ];
    }
}
