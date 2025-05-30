<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first(); // Random product

        return [
            'order_id' => Order::factory(), // Create an order using the OrderFactory
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 5), // Random quantity
            'price' => $product->price, // Use the product's price
        ];
    }
}
