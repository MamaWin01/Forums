<?php

namespace Tests\Feature;

use App\Models\Channel;
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

    /** @test */
    public function a_thread_require_title()
    {
        $this->PublishThread(['title'=> null])
        ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_require_body()
    {
        $this->PublishThread(['body'=> null])
        ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_require_valid_channel_id()
    {
        Channel::factory(2)->create();

        $this->PublishThread(['channel_id'=> null])
        ->assertSessionHasErrors('channel_id');

        $this->PublishThread(['channel_id'=> 999])
        ->assertSessionHasErrors('channel_id');
    }

    public function PublishThread($overrides = [])
    {
        $this->signIn();

        $thread = make(Thread::class, $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
