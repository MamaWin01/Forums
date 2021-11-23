<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_see_thread_according_to_a_channel()
    {
        $channel = create(Channel::class);
        $ThreadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $ThreadNotInChannel = create(Thread::class);

        $this->signIn()->get("/threads/$channel->slug")
            ->assertSee($ThreadInChannel->title)
            ->assertDontSee($ThreadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(create(User::class, ['name' => 'Kevin']));

        $threadByKevin = create(Thread::class, ['user_id' => auth()->id()]);
        $threadNotByKevin = create(Thread::class);

        $this->call('GET', '/threads', ['by' => 'Kevin'])
            ->assertSee($threadByKevin->title)
            ->assertDontSee($threadNotByKevin->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadWithThreeReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithNoReplies = create(Thread::class);

        $response = $this->get('/threads?popular=1');

        $response->assertSeeTextInOrder(['3 replies','2 replies', '0 replies']);
    }
}
