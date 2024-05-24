<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Common\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware; // ? comment out to enable middleware check


class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    // use RefreshDatabase; // ? try with middleware (buggy)

    #[Test]
    public function test_it_displays_the_index_page_with_products()
    {
        /*
        // Create an admin user
        $admin = Admin::factory()->create();

        // Authenticate as the admin user
        $this->actingAs($admin)
            ->get(route('product.index'))
            ->assertStatus(200); // Assert the response status code
        */

        // Create some products
        $products = Product::factory()->count(3)->create();

        // Send a GET request to the index route
        $response = $this->get(route('product.index'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert the view has the products
        $response->assertViewHas('products', function ($viewProducts) use ($products) {
            return $viewProducts->contains($products->first());
        });
    }

    // Add more tests as needed...
}
