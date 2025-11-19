<?php

namespace Tests\Feature;

use App\Models\Siswa;
use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;

class SiswaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat role admin
        \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Buat user admin
        $this->user = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $this->user->assignRole('admin');
    }

    /** 1. Halaman siswa dapat diakses */
    public function test_halaman_siswa_terbuka()
    {
        Siswa::factory()->count(3)->create(['is_delete' => false]);

        $response = $this->actingAs($this->user)->get(route('siswa.view'));

        $response->assertStatus(200);
        $response->assertViewIs('halamansiswa');
        $response->assertViewHas('siswas');
    }

    /** 2. Halaman karya siswa dapat diakses */
    public function test_halaman_karya_siswa_terbuka()
    {
        $siswa = Siswa::factory()->create(['is_delete' => false]);

        // Buat karya siswa
        $siswa->karyas()->create([
            'judul' => 'Drift King',
            'kategori' => 'Game',
            'deskripsi' => 'Game Mobil Bertema Drifting',
            'gambar' => 'karya_images/foto.jpg',
            'link_demo' => 'https://www.onlinegames.io/games/2024/unity/drift-king',
            'view' => 0,
            'is_delete' => false,
        ]);

        $response = $this->actingAs($this->user)
                 ->get(route('siswa.lihatkarya', ['id' => $siswa->id]));

        $response->assertStatus(200);
        $response->assertViewIs('lihatkarya'); // sesuai controller
        $response->assertViewHas('karya');      // sesuai compact('karya') di controller
        }



    /** 3. Halaman sampah siswa dapat diakses */
    public function test_halaman_sampah_siswa_terbuka()
    {
        Siswa::factory()->count(2)->create(['is_delete' => true]);

        $response = $this->actingAs($this->user)
                         ->get(route('siswa.sampah'));

        $response->assertStatus(200);
        $response->assertViewIs('sampahsiswa');
        $response->assertViewHas('siswas');
    }

    /** 4. Menampilkan form pendaftaran siswa dengan token valid */
    public function test_show_form_with_valid_token()
    {
        $token = Token::create(['token' => 'token123', 'is_used' => false]);

        $response = $this->actingAs($this->user)
                         ->get(route('form.daftar', ['token' => $token->token]));

        $response->assertStatus(200);
        $response->assertViewIs('formsiswa');
        $response->assertViewHas('token', 'token123');
    }

    /** 5. Menampilkan form pendaftaran siswa dengan token invalid */
    public function test_show_form_with_invalid_token_redirects()
    {
        $token = Token::create(['token' => 'token123', 'is_used' => true]);

        $response = $this->actingAs($this->user)
                         ->get(route('form.daftar', ['token' => $token->token]));

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHasErrors();
    }

    /** 6. Generate link dan simpan token berhasil */
    public function test_generate_link_creates_token_and_returns_success()
    {
        Storage::fake('public');

        $response = $this->actingAs($this->user)
                         ->post(route('generate.link'), [
                             'token' => 'tokenbaru',
                             'password' => 'admin'
                         ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('tokens', ['token' => 'tokenbaru']);
    }

    /** 7. Menambah siswa baru berhasil dengan pengecekan file */
    public function test_tambah_siswa_dengan_token_valid()
{
    Storage::fake('public');

    $token = Token::create([
        'token' => 'tokentest',
        'is_used' => false
    ]);

    $file = UploadedFile::fake()->image('foto.jpg');

    $response = $this->actingAs($this->user)
        ->post(route('siswa.add', ['token' => $token->token]), [
            'nama_siswa' => 'Budi',
            'no_hp' => '08123456789',
            'pendidikan' => 'SMA',
            'kelas' => 'X',
            'alamat' => 'Jakarta',
            'kota' => 'Jakarta',
            'foto_siswa' => $file
        ]);

    $response->assertRedirect(route('siswa.view'));
    $response->assertSessionHas('success', '✅ Pendaftaran siswa baru berhasil disimpan!');

    // Pastikan siswa tersimpan
    $this->assertDatabaseHas('siswas', ['nama_siswa' => 'Budi']);

    // Refresh token & cek sudah dipakai
    $token->refresh();
    $this->assertTrue($token->is_used);

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');
        $disk->assertExists('siswa_images/' . Str::slug('Budi') . '.jpg');

}


    /** 8. Update siswa berhasil */
    public function test_update_siswa_berhasil()
    {
        $siswa = Siswa::factory()->create(['nama_siswa' => 'Lama']);

        $response = $this->actingAs($this->user)
                         ->post(route('siswa.update', ['id' => $siswa->id]), [
                             'nama_siswa' => 'Baru',
                             'no_hp' => '08123456789',
                             'pendidikan' => 'SMA',
                             'kelas' => 'X',
                             'alamat' => 'Jakarta',
                             'kota' => 'Jakarta',
                         ]);

        $response->assertRedirect(route('siswa.view'));
        $response->assertSessionHas('success', '✅ Data Siswa Berhasil Diupdate');
        $this->assertDatabaseHas('siswas', ['id' => $siswa->id, 'nama_siswa' => 'Baru']);
    }

    /** 9. Delete siswa berhasil */
    public function test_delete_siswa()
    {
        $siswa = Siswa::factory()->create(['is_delete' => false]);

        // Sesuaikan method sesuai route (POST jika route delete pakai POST)
        $response = $this->actingAs($this->user)
                         ->post(route('siswa.delete', ['id' => $siswa->id]));

        $response->assertRedirect(route('siswa.view'));
        $this->assertDatabaseHas('siswas', ['id' => $siswa->id, 'is_delete' => true]);
    }

    /** 10. Restore siswa berhasil */
    public function test_restore_siswa()
    {
        $siswa = Siswa::factory()->create(['is_delete' => true]);

        $response = $this->actingAs($this->user)
                         ->post(route('siswa.restore', ['id' => $siswa->id]));

        $response->assertRedirect(route('siswa.view'));
        $this->assertDatabaseHas('siswas', ['id' => $siswa->id, 'is_delete' => false]);
    }
}
