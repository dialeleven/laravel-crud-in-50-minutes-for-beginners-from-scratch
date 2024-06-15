<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\AdminSite\Admin;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Log; // Add this import


class AuthRoutesTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    #use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Manually insert roles into the admin_roles table
        DB::table('admin_roles')->insertOrIgnore([
            ['id' => 1, 'name' => 'superadmin'],
            ['id' => 2, 'name' => 'admin'],
            ['id' => 3, 'name' => 'user'],
        ]);

        #Log::info('SetUp complete: Admin roles inserted.');
    }


    public function testShowsForgotPasswordForm()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.login.forgot_password');
    }

    
    
    public function testSendsResetLinkToAdmin()
    {
        Notification::fake();

        $test_email = 'admin@example.com';

        // Create a new admin record for testing
        $admin = Admin::factory()->create([
            'role_id' => 1, // Ensuring a valid role_id is used
            'email' => $test_email,
        ]);

        // Assert that the admin record was created successfully
        $this->assertDatabaseHas('admins', [
            'id' => $admin->id,
            'email' => $test_email,
        ]);

        // Log in the admin user using the 'admin' guard (in 'config/auth.php')
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('password.send_reset_link'), [
            'email' => $test_email,
        ]);

        $response->assertStatus(302);  // Check if it redirects
        $response->assertSessionHas('success');

        Notification::assertSentTo([$admin], ResetPassword::class);
    }
}