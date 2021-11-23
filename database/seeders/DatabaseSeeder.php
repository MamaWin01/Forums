<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\User;
use App\Models\Thread;
use App\Models\Channel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Channel::factory(5)->create()->each(function ($channel) {
            Thread::factory(4)->create(['channel_id' => $channel->id])->each(function ($thread) {
                Reply::factory(5)->create(['thread_id' => $thread->id]);
            });
        });
        User::insert([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>bcrypt('password')
        ]);
    }
}
