<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);

        $response = $this->post(route('products.store'), [
            'name' => 'New Product',
            'price' => 10.99,
            'description' => 'Description of the product',
            'available' => true,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    public function testUpdateProduct()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);

        $product = Product::factory()->create([
            'name' => 'Original Product',
            'price' => 19.99,
            'description' => 'Original description',
            'available' => true,
        ]);

        $response = $this->put(route('products.update', $product->id), [
            'name' => 'Updated Product',
            'price' => 15.99,
            'description' => 'Updated description',
            'available' => false,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Updated Product']);
    }

    public function testViewProduct()
    {

        $client = User::factory()->create()->assignRole('client');

        $this->actingAs($client);

        $product = Product::factory()->create(['name' => 'Product to View']);

        $response = $this->get(route('products.show', $product->id));

        $response->assertStatus(200);
        $response->assertSee('Product to View');
    }

    public function testDeleteProduct()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);

        $product = Product::factory()->create(['name' => 'Product to Delete']);

        $response = $this->delete(route('products.destroy', $product->id));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['name' => 'Product to Delete']);
    }

}





