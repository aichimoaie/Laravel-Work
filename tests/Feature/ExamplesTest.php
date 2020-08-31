<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class ExamplesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_responds_to_show_my_roles()
    {
        //$this->artisan('db:seed');

        $user = \App\User::find(3);
        $this->actingAs($user)->assertAuthenticated();

        $response = $this->get('api/my_roles');
     //   var_dump($response);
       // $response->assertStatus(200);
        $response->assertSee('Collection');
        $response->assertSee('writer');
    }
   /** @test */
    public function it_responds_to_show_my_roles2(){
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $response =  $this->json('GET', 'api/my_roles' , ['Accept' => 'application/json'])
        ->assertStatus(200);
        $response->assertSee('items');
        $response->assertSee('super-admin');

     
    }
}