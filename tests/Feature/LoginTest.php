<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * Attempt to see the login screen
     *
     * @return void
     */
     public function testGuestVisitingLoginPage()
     {
         $response = $this->get('/login');
         $response->assertSee('E-Mail Address');
         $response->assertSee('Password');
     }

     /**
      * Test if a valid user can see the page
      *
      * @return void
      */
     public function testValidUserVisitingLoginPage()
     {
        $member = factory(\App\User::class)->create();
        $this->be($member);

        $response = $this->get('/login');
        $response->assertStatus(302);
        $response->assertRedirect('/home');
     }
}
