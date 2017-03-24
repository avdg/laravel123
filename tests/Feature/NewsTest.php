<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsTest extends TestCase
{
    /**
     * Test if a guest will be redirected
     *
     * @return void
     */
    public function testGuestUser()
    {
        $response = $this->get('/news');

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test if a valid user can see the page
     *
     * @return void
     */
    public function testValidUser()
    {
        $member = factory(\App\User::class)->create();
        $this->be($member);

        $response = $this->get('/news');
        $response->assertSee("Overview");
    }
}
