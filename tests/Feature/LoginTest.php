<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function it_can_login_a_user()
    {
        $johnDoe = [
            'email' => 'john.doe@gmail.com',
            'password' => 'password'
        ];

        factory(User::class)->create($johnDoe);

        $response = $this->post('/api/login', $johnDoe);
        $response->assertJsonStructure(['message','token']);
        $response->assertOk();
    }

    /** @test */
    public function it_can_access_protected_route_when_logged_in()
    {
        $johnDoe = [
            'email' => 'john.doe@gmail.com',
            'password' => 'password'
        ];

        factory(User::class)->create($johnDoe);

        $loginResponse = $this->post('/api/login', $johnDoe);
        $header = ['Authorization' => 'Bearer ' . $loginResponse->json()['token']];
        $response = $this->withHeaders($header)->get('/api/users');
        $response->assertOk();
    }

    /** @test */
    public function it_can_return_error_when_invalid_credential_is_passed()
    {
        factory(User::class)->create([
            'email' => 'john.doe@gmail.com',
            'password' => 'password'
        ]);

        $wrongEmailResponse = $this->json('post', '/api/login', [
            'email' => 'john.doe@wrong-email.com',
            'password' => 'password'
        ]);
        $wrongEmailResponse->assertUnauthorized();
        $wrongEmailResponse->assertJsonStructure(['message']);

        $wrongPasswordResponse = $this->json('post', '/api/login', [
            'email' => 'john.doe@gmail.com',
            'password' => 'wrong-password'
        ]);
        $wrongPasswordResponse->assertUnauthorized();
        $wrongPasswordResponse->assertJsonStructure(['message']);
    }

    /** @test */
    public function it_can_return_error_when_invalid_data_attribute_is_passed()
    {
        factory(User::class)->create([
            'email' => 'john.doe@gmail.com',
            'password' => 'password'
        ]);

        $response = $this->json('post', '/api/login', [
            'email_invalid_attribute' => 'john.doe@gmail.com',
            'password_invalid_attribute' => 'password'
        ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors' => ['email', 'password']
        ]);
    }
}
