<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Buat role admin agar bisa dipakai di test
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    }

    /** Halaman login dapat diakses ketika belum login */
    public function test_halaman_login_dapat_diakses_ketika_belum_login()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
        $response->assertViewIs('login');
    }

    /** Redirect jika sudah login sebagai admin */
    public function test_halaman_login_redirect_jika_sudah_login_admin()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)
             ->get(route('login'))
             ->assertRedirect(route('admindashboard'));
    }

    /** Login berhasil sebagai admin */
    public function test_login_berhasil_sebagai_admin()
    {
        $admin = User::factory()->create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');

        $response = $this->post(route('login.proses'), [
            'email' => 'admin@gmail.com',
            'password' => 'admin',
        ]);

        $response->assertRedirect(route('admindashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    /** Login gagal karena email/password salah */
    public function test_login_gagal_email_atau_password_salah()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('login.proses'), [
            'email' => 'user@example.com',
            'password' => 'wrongpassword',
        ]);

        // Sesuaikan assertSessionHasErrors agar kompatibel Laravel 12
        $response->assertSessionHas('errors');
        $this->assertStringContainsString('Email atau password salah', session('errors')->first());
        $this->assertGuest();
    }

    /** Login gagal karena bukan admin */
    public function test_login_gagal_bukan_admin()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);
        // Tidak assign role admin

        $response = $this->post(route('login.proses'), [
            'email' => 'user@example.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHas('errors');
        $this->assertStringContainsString('Anda tidak memiliki akses sebagai admin', session('errors')->first());
        $this->assertGuest();
    }

    /** Logout berhasil */
    public function test_logout_berhasil()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');

        $this->actingAs($admin)
             ->post(route('logout'))
             ->assertRedirect(route('login'));

        $this->assertGuest();
    }
    /** 7. Akses login page ketika sudah login user non-admin harus redirect */
    public function test_login_page_redirects_for_logged_in_non_admin()
    {
        $user = User::factory()->create();
        // Tidak assign role admin

        $this->actingAs($user)
             ->get(route('login'))
             ->assertRedirect(route('admindashboard')); // Bisa sesuaikan controller jika perlu
    }

    /** 8. Login gagal jika email tidak terdaftar */
    public function test_login_gagal_email_tidak_terdaftar()
    {
        $response = $this->post(route('login.proses'), [
            'email' => 'tidakada@example.com',
            'password' => 'randompass',
        ]);

        $response->assertSessionHasErrors('error');
        $this->assertStringContainsString('Email atau password salah', session('errors')->first('error'));
        $this->assertGuest();
    }
}

