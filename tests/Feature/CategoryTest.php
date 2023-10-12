<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateCategory()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);


        $response = $this->post(route('categories.store'), ['name' => 'Test Category']);

        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', ['name' => 'Test Category']);
    }

    public function testDestroyCategory()
    {
        $admin = User::factory()->create()->assignRole('admin');

        $this->actingAs($admin);

        $category = Category::factory()->create(['name' => 'Test Category']);
        $response = $this->delete(route('categories.destroy', $category->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('categories', ['name' => 'Test Category']);
    }

}





