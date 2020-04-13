<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class UserTest extends TestCase
{
    public $testUserDetails = [
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'john.doe@gmail.com',
        'password' => 'password'
    ];
    /** @test */
    public function it_can_register_a_user()
    {
        $response = $this->post('/api/users', $this->testUserDetails);
        $response->assertOk();
        $response->assertExactJson(['message' => 'success']);
        $this->assertDatabaseHas('users', collect($this->testUserDetails)->except(['password'])->toArray());
    }

    /** @test */
    public function it_cannot_register_existing_email()
    {
        factory(User::class)->create($this->testUserDetails);
        $response = $this->json('post', '/api/users', $this->testUserDetails);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonStructure([
            'message',
            'errors' => ['email']
        ]);
    }

    /** @test */
    public function it_can_return_error_when_data_is_invalid()
    {
        $response = $this->json('post', '/api/users', [
            'first_name' => '',
            'last_name' => '',
            'email' => 'invalid email here',
            'password' => ''
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'first_name',
                'last_name',
                'email',
                'password'
            ]
        ]);
    }
}
