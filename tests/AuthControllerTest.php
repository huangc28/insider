<?php

use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;

/**
 * @todo use sqlite instead of touching real DB.
 * @todo migrate tables.
 * @todo seed data
 */
class AuthControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp () {
        parent::setUp();

        Artisan::call('db:seed');
    }

    /**
     * Test login success.
     */
    public function testLoginSuccess()
    {
        // retrieve password from first user.
        $testUser = DB::table('users')
            ->where('username', 'test')
            ->first();

        $response = $this->call('POST', '/login', [
          'email' => 'test@gmail.com',
          'password' => $testUser->password
        ]);

        $response = $response->getData(true);

        // assert api_token is not empty
        $this->assertEquals(empty($response['api_token']), false);

        // assert status is 200
        $this->assertEquals($response['status'], '200');
    }

    /**
     * Test password not matched
     */
    public function testLoginFailedPasswordNotMatched ()
    {
        $response = $this->call('POST', '/login', [
            'email' => 'test@gmail.com',
            'password' => 'someransompass'
        ]);

        $response = $response->getData(true);

        $expectedResponse = [
            'status' => '400',
            'error' => [
                'message' => 'please insert correct password'
            ]
        ];

        $this->assertEquals($response, $expectedResponse);
    }

    public function testLoginSuccessUserNotFound ()
    {
        $response = $this->call('POST', '/login', [
            'email' => 'test',
            'password' => 'someransompass'
        ]);

        $response = $response->getData(true);

        $expectedResponse = [
            'status' => 404,
            'error' => [
                'message' => 'user not found'
            ]
        ];

        $this->assertEquals($expectedResponse, $response);
    }
}
