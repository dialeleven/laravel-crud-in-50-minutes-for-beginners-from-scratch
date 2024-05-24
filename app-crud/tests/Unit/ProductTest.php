<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Common\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** test */
    public function it_checks_if_product_has_name_attribute()
    {
        $product = Product::factory()->make([
            'name' => 'Test Product'
        ]);

        $this->assertEquals('Test Product', $product->name);
    }

    // Add more tests as needed...
}