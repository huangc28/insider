<?php

use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\DatabaseMigrations;

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
        $response = $this->call('POST', '/login', [
          'email' => 'test@gmail',
          'password' => 'passwordabc'
        ]);

        $response = $response->getData(true);

        // assert api_token is not empty
        $this->assertEquals(empty($response['api_token']), false);

        // assert status is 200
        $this->assertEquals($response['status'], '200');
    }
}
