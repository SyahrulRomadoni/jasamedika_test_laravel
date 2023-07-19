<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User; // Make sure to include the User model

class KelurahanTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $user = User::where('role', 'admin')->first();
        $this->actingAs($user);
    }

    public function test_index_kelurahan(): void
    {
        $response = $this->get(route('kelurahan.index'));

        $response->assertViewIs('layouts.page.kelurahan.index');
    }

    public function test_create_kelurahan(): void
    {
        $response = $this->post(route('kelurahan.create'), [
            'id' => '1',
            'kelurahan' => 'Test Kel',
            'kecamatan' => 'Test Kec',
            'kota' => 'Test kota',
        ]);

        $response->assertStatus(200);
    }

    public function test_edit_kelurahan(): void
    {
        $response = $this->get(route('kelurahan.edit', [
            'id' => '1'
        ]));

        $response->assertStatus(200);
    }

    public function test_update_kelurahan(): void
    {
        $response = $this->post(route('kelurahan.update'), [
            'id' => '1',
            'kelurahan' => 'Test Update Kel',
            'kecamatan' => 'Test Update Kec',
            'kota' => 'Test Update kota',
        ]);

        $response->assertStatus(200);
    }
}
