<?php

namespace Tests\Unit;

use App\Models\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function every_reply_has_owner()
    {
        $reply = create(Reply::class);

        $this->assertInstanceOf('App\Models\User', $reply->owner);
    }
}
