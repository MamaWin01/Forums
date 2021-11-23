@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}
                    </a> posted {{ $thread->title }}
                </div>
                <div class="card-body">
                    <article>
                        <div class="body">{{ $thread->body }}</div>
                    </article>
                    <hr>
                </div>
            </div>
            <div class="card-header mb-2">Replies</div>
            @foreach($replies as $reply)
                @include('thread.reply')
            @endforeach
            {{ $replies->links() }}
            @if(auth()->check())
            <form method="POST" action="/threads/{{ $thread->channel->slug }}/{{ $thread->id }}/reply">
                @csrf
                <div class="form-group">
                    <label for="body">Reply</label>
                    <textarea type="text" class="form-control" id="body" name="body" placeholder="Comment here..." rows='5'></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Reply</button>
            </form>
            @else
            <div>
                <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in the discussion</p>
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <article>
                        <div class="body">This post was created {{ $thread->created_at->diffForHumans() }} with {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}</div>
                    </article>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
