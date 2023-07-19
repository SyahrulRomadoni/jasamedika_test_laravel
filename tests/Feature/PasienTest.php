<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasienTest extends TestCase
{
    protected function setUp() : void {
        parent::setUp();
        $user = User::where('role', 'operator')->first();
        $this->actingAs($user);
    }

    public function test_index_pasien(): void
    {
        $response = $this->get(route('pasien.index'));

        $response->assertViewIs('layouts.page.pasien.index');
    }

    public function test_create_pasien(): void
    {
        $response = $this->post(route('pasien.create'), [
            'id' => null,
            'nama' => 'Test Nama Pasien',
            'alamat' => 'Test Alama Pasien',
            'no_telepon' => '0800000000100',
            'id_kelurahan' => '2',
            'rt_rw' => '02/02',
            'tanggal_lahir' => '2023-07-19',
            'jenis_kelamin' => '2',
        ]);

        $response->assertStatus(200);
    }

    public function test_cetak_kartu_pasien(): void
    {
        $response = $this->get(route('pasien.cetak.kartu', ['no_pasien' => '2307000001']));

        $response->assertStatus(200);
    }
}
