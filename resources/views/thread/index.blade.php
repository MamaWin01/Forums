@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @foreach($threads as $thread)
                        <article class="mb-4">
                            <div class="d-flex align-items-center mb-1">
                                <h4 class="flex-grow-1">
                                    <a href="/threads/{{ $thread->channel->slug }}/{{ $thread->id }}">
                                        {{ $thread->title }}
                                    </a>
                                </h4>
                                <a href="/threads/{{ $thread->channel->slug }}/{{ $thread->id }}">
                                    <strong>{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</strong>
                                </a>
                            </div>
                            <div class="body">{{ $thread->body }}</div>
                            <hr>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
