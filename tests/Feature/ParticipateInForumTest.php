<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function unauthenticated_user_cant_participate_in_forum_thread()
    {
        $this->post("/threads/asd/1/reply", [])->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_may_participate_in_forum_thread()
    {
        $thread = create(Thread::class);

        $reply = make(Reply::class);
        
        $this->signIn()->post("/threads/$thread->channel/$thread->id/reply", $reply->toArray());

        $this->get("/threads/$thread->channel/$thread->id")->assertSee($reply->body);
    }
}
