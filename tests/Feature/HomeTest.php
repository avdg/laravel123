<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A guest visiting the home screen should be redirected to the login screen
     *
     * @return void
     */
    public function testGuestVisitingHomePage()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test if a valid user can see the page
     *
     * @return void
     */
    public function testValidUserVisitingHomePage()
    {
        $member = factory(\App\User::class)->create();
        $this->be($member);

        $response = $this->get('/home');
        $response->assertSee("You are logged in!");
    }
}
