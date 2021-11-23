<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_cannot_create_new_thread()
    {
        $this->get('/threads/create')->assertRedirect('/login');
        
        $this->post('/threads')->assertRedirect('/login');

    }

    /** @test */
    public function authenticated_user_may_create_new_thread()
    {
        $this->signIn();

        $thread = Thread::factory()->make();

        $this->post('/threads', $thread->toArray());

        $this->get('/threads')
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }   
}
