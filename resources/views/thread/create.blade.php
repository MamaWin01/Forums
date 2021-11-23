@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a new Thread</div>
                <div class="card-body">
                    <form action={{ route('threads.store') }} method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="channel_id">Channel Name</label>
                            <select class="custom-select form-control @error('channel_id') is-invalid @enderror" name="channel_id">
                                <option value="" selected>Choose one...</option>
                                @foreach($channels as $channel)
                                <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                                @endforeach
                            </select>
                            @error('channel_id')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Thread Title.." value="{{ old('title') }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="body">Content</label>
                            <textarea type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" placeholder="Thread Content.." rows="8" value="{{ old('body') }}"></textarea>
                            @error('body')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
