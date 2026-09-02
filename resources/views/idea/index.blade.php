<x-layout>
    <div class="text-muted-foreground">
        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2"> Capture yor thoughts. Make a plan.</p>
        </header>
        <div class="mt-10">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse($ideas as $idea)
                    <x-card :idea="$idea"/>
                @empty
                    <h2 class="text-4xl font-bold text-purple-600 ">No ideas at this time</h2>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
