<?php
/// tests/Feature/AuthenticationControllerTest.php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AuthenticationControllerTest extends TestCase

{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_register()
    {
        $response = $this->postJson('/api/register', [
            'id_usuario' => 'testuser',
            'nombre' => 'Test',
            'apellidoP' => 'User',
            'apellidoM' => 'Example',
            'email' => 'test@example.com',
            'password' => 'password123',
            'rol' => 'admin',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'id_usuario' => 'testuser',
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function a_user_can_login()
    {
        $user = User::factory()->create([
            'id_usuario' => 'testuser',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/login', [
            'id_usuario' => 'testuser',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_get_user_info()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'api')->getJson('/api/get-user');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'response_code',
            'status',
            'message',
            'data_user_list' => [
                'data' => [
                    '*' => [
                        'id_usuario',
                        'nombre',
                        'apellidoP',
                        'apellidoM',
                        'email',
                        'rol',
                        'activo',
                    ],
                ],
            ],
        ]);
    }

    /** @test */
    public function it_can_get_specific_user_info()
    {
        $user = User::factory()->create([
            'id_usuario' => 'testuser',
        ]);

        $response = $this->actingAs($user, 'api')->getJson('/api/user1', ['id_usuario' => 'testuser']);

        $response->assertStatus(200);
        $response->assertJsonFragment(['id_usuario' => 'testuser']);
    }
}
