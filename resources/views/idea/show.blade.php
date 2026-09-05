<x-layout.layout :title="$idea->title">

    <div class="font-bold max-w-4xl mx-auto mt-6">

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('ideas.index') }}" class="flex items-center gap-2 text-sm font-medium">
                <x-icons.arrow-back />
                Back to Ideas
            </a>

            <div class="gap-x-3 flex items-center">

                <button
                    x-data
                    class="btn btn-outlined"
                    data-test="edit-idea-button"
                    @click="$dispatch('open-modal', 'edit-idea')"
                >
                    <x-icons.external />
                    Edit
                </button>

                <form
                    action="{{ route('ideas.destroy', $idea->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outlined hover:text-red-500"
                    >
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <h3 class="text-foreground text-lg mb-3">{{ $idea->title }}</h3>

        @if ($idea->image_path)
            <div class="rounded-lg overflow-hidden ">
                <img src="{{ asset('storage/' . $idea->image_path) }}" alt=""
                    class="w-full h-auto aspect-video mx-auto mb-2 rounded-lg" />
            </div>
        @endif


        <div @class(['border border-border rounded-lg bg-card p-4 md:text-sm'])>

            <div class="flex items-center gap-2">
                <x-idea.status-label :status="$idea->status" />
                <p class="text-xs text-muted-foreground">{{ $idea->created_at->diffForHumans() }}</p>
            </div>

            <div class="mt-5 description">{!! $idea->description !!}</div>
        </div>

        @if ($idea->steps->count())
            {{-- <x-idea.repeater :variables="$idea->steps" title="Actionable Steps" :content="'steps'" /> --}}
        @endif
        @if ($idea->links->count())
            {{-- <x-idea.repeater :variables="$idea->links" title="Idea Links" :content="'links'" /> --}}
        @endif

        {{-- <x-idea.modal :idea="$idea" /> --}}

        @if ($idea->links->count())

            <div>
                <h3 class="font-bold text-xl mt-6">
                    Links
                </h3>

                <div class="mt-3 space-y-2">

                    @foreach ($idea->links as $link)
                        {{-- <x-card :href="$link" class="text-primary font-medium felx gap-x-3 items-center"> --}}
                            <x-icons.external />
                            {{ $link }}
                        {{-- </x-card> --}}
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-layout.layout>
