<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_password_is_hashed()
    {
        $password = Str::random();

        $user = User::factory()->create(['password' => $password]);

        $this->assertTrue(Hash::check($password, $user->password));
    }

    /** @test */
    public function a_user_can_register()
    {
        // spawn a virtual user
        $user = $user = User::factory()->make();

        // register the user
        $this
            ->post('api/register', [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'password',
            ])
            ->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('user')
                    ->has('token')
                    ->has('message')
                    ->etc()
            );
    }

    /** @test */
    public function a_user_can_login()
    {
        // spawn a user
        $user = User::factory()->create();

        // login the user
        $this
            ->post('api/login', [
                'email' => $user->email,
                'password' => 'password'

            ])
            ->assertStatus(201)
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->has('user')
                    ->has('token')
                    ->has('message')
                    ->etc()
            );
    }

    /** @test */
    public function a_user_can_logout()
    {
        // spawn a user
        $user = User::factory()->create();

        // issue token
        $token = $user->createToken('apitoken')->plainTextToken;

        // the token should be valid
        $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->get('api/user')
            ->assertStatus(200);

        // logout the user
        $this
            ->withHeader('Authorization', 'Bearer ' . $token)
            ->post('api/logout')
            ->assertJson(
                fn (AssertableJson $json) =>
                $json->where('message', 'Bye')->etc()
            );

        // the token should be invalidated
        $r = $this
            ->withHeader('Authorization', 'Bearer ' . $token . 'l')
            ->get('api/user')
            ->assertStatus(401);
    }
}
