
<a
    href="{{route('ideas.show', ['idea' => $idea])}}"
    {{ $attributes(['class'=>'border border-border rounded-lg bg-card p-4 md:text-sm'])}}
>
    @if ($idea->image_path)
        <div class="mb-4 -mx-4 -mt-4 rounded-t-lg overflow-hidden">
            <img src="{{ asset('storage/' . $idea->image_path ) }}" alt="{{ $idea->title }}"
                class="w-full h-48 object-cover" />
        </div>
    @endif

    <h3 class="text-foreground text-lg">{{$idea->title}}</h3>

    <x-idea.status-label :status="$idea->status" />

    <div class="mt-5 line-clamp-3">{{ $idea->description }}</div>
    <div class="mt-4">{{ $idea->created_at->diffForHumans() }}</div>
</a>
