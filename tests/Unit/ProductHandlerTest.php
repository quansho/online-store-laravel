<?php

namespace Tests\Unit;

use App\Commands\Product\CreateProductCommand;
use App\DTO\Creators\ProductDTOFactory;
use App\Handlers\CreateProductCommandHandler;
use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class ProductHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProduct()
    {
        $repository = Mockery::mock(ProductRepositoryInterface::class);
        $repository->shouldReceive('create')->andReturnUsing(function ($data) {
            return new Product([
                'name' => $data->name,
                'price' => $data->price,
                'description' => $data->description,
                'available' => $data->available,
            ]);
        });

        $handler = new CreateProductCommandHandler($repository);

        $productDTO = ProductDTOFactory::create(
            'New Product',
            10.99,
            'Description of the product',
            true,
        );

        $command = new CreateProductCommand($productDTO);

        $product = $handler->handle($command);

        $this->assertEquals('New Product', $product->name);
    }


    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
