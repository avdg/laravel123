<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexPage()
    {
        $response = $this->get('/');

        $response->assertSee("Laravel");
        $response->assertStatus(200);
    }

    /**
     * Attempt to see the login screen
     *
     * @return void
     */
     public function testLoginPage()
     {
         $response = $this->get('/login');
         $response->assertSee('E-Mail Address');
         $response->assertSee('Password');
     }
}
