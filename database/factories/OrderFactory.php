<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::first()->id, // Random user
            'address_id' => UserAddress::inRandomOrder()->first()->id, // Random address
            'total_amount' => $this->faker->randomFloat(2, 100, 10000), // Random total amount
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            // Create random order items for the order
            \App\Models\OrderItem::factory()->count(rand(1, 5))->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
