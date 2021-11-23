<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp() :void
    {
        parent::setUp();

        $this->thread = create(Thread::class);
    }

    /** @test */
    public function user_can_read_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertSeeText($this->thread->title);
    }

    /** @test */
    public function user_can_read_single_thread()
    {
        $response = $this->get('/threads/' . $this->thread->channel . '/' . $this->thread->id);
        $response->assertSeeText($this->thread->title);
    }

    /** @test */
    public function user_can_read_replies_that_associated_with_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get('/threads/' . $this->thread->channel . '/' .  $this->thread->id)->assertSeeText($reply->body);
    }
}
