<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengguna>
 */
class PenggunaFactory extends Factory
{
    /**
     * Nama model yang terkait dengan factory.
     *
     * @var string
     */
    protected $model = Pengguna::class;

    /**
     * Password yang digunakan secara default.
     */
    protected static ?string $password;

    /**
     * Definisikan state default untuk model Pengguna.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password123'),
            'peran' => fake()->randomElement(['admin', 'guru', 'siswa', 'orang_tua']),
            'status' => 'aktif',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * State untuk akun dengan peran Admin.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'admin',
        ]);
    }

    /**
     * State untuk akun dengan peran Guru.
     */
    public function guru(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'guru',
        ]);
    }

    /**
     * State untuk akun dengan peran Siswa.
     */
    public function siswa(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'siswa',
        ]);
    }

    /**
     * State untuk akun dengan peran Orang Tua.
     */
    public function orangTua(): static
    {
        return $this->state(fn (array $attributes) => [
            'peran' => 'orang_tua',
        ]);
    }
}
