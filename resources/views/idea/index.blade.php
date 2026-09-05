<x-layout>
    <div class="text-muted-foreground">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2"> Capture your thoughts. Make a plan.</p>

            <x-card
                x-data
                @click="$dispatch('open-modal', 'create-idea')"
                is="button"
                type="button"
                class="mt-10 cursor-pointer h-32 w-full text-left"
            >
                <p>What's the idea?</p>
            </x-card>
        </header>

        <div>
            <a
                href="/ideas"
                class="btn {{ request()->has('status') ? 'btn-outlined' : '' }}"
            >
                All
                <span class="text-xs pl-3">
                    {{ $statusCounts->get('all') }}
                </span>
            </a>

            @foreach (App\IdeaStatus::cases() as $status)

                <a
                    href="/ideas?status={{ $status->value }}"
                    class="btn {{ request('status') === $status->value ? '' : 'btn-outlined' }}"
                >
                    {{ $status->label() }}
                    <span class="text-xs pl-3">
                        {{ $statusCounts->get($status->value) }}
                    </span>
                </a>
            @endforeach
        </div>

        <div class="mt-10">
            <div class="grid md:grid-cols-2 gap-6">

                @forelse($ideas as $idea)
                    <x-idea.card :idea="$idea"/>
                @empty
                    <h2 class="text-4xl font-bold text-purple-600 ">No ideas at this time</h2>
                @endforelse
            </div>
        </div>

        <x-modal name="create-idea" title="New Idea">
            <p>Slot content here.</p>
        </x-modal>
    </div>
</x-layout>
