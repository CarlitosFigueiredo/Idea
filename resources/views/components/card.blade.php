<a href="{{route('ideas.show', $idea->id)}}" {{ $attributes(['class'=>'border border-border rounded-lg bg-card p-4 md:text-sm'])}} >
    <h3 class="text-foreground text-lg">{{$idea->title}}</h3>

    <x-idea.status-label :status="$idea->status" />

    <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
    <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
</a>
