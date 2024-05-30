<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Support\Facades\Password;


class AuthRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testShowsForgotPasswordForm()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.login.forgot_password');
    }

    /*
    // ? not working - 'Error: Class "Database\Factories\AdminModels\AdminFactory" not found'
    public function testSendsResetLinkToAdmin()
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
        ]);

        $response = $this->actingAs($admin, 'admin')
                         ->post(route('password.send-reset-link'), [
                             'email' => 'admin@example.com',
                         ]);

        $response->assertStatus(302); // Redirected back after sending the link
        $response->assertSessionHas('status', trans(Password::RESET_LINK_SENT));
    }
    */
}