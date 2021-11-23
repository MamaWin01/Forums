<div class="card mb-4">
    <div class="card-header">
        <a href="#" >{{ $reply->owner->name }}
        </a> at {{ $reply->created_at->diffForHumans() }}
    </div>
    <div class="card-body">
        <article>
            <div class="body">{{ $reply->body }}</div>
        </article>
        <hr>
    </div>
</div>