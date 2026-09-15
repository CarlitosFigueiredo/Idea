<x-layout>
    <div class="text-muted-foreground">

        <header class="py-8 md:py-12">
            <h1 class="text-3xl font-bold">Ideas</h1>
            <p class="text-muted-foreground text-sm mt-2"> Capture yor thoughts. Make a plan.</p>
        </header>

        <x-card
            x-data
            @click="$dispatch('open-modal', 'create-idea')"
            is="button"
            type="button"
            data-test="create-idea-button"
            class="mt-10 cursor-pointer h-32 w-full text-left"
        >
            <p>What's the idea?</p>
        </x-card>


        <div class="mt-10">

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

                    <h2 class="text-4xl font-bold text-purple-600 ">
                        No ideas at this time
                    </h2>
                @endforelse
            </div>
        </div>

        <x-modal
            name="create-idea"
            title="New idea"
        >
            <form
                x-data="{
                    status:'pending',
                    newLink:'',
                    links:[],
                    newStep:'',
                    steps:[],
                }"
                method="POST"
                action="{{ route('ideas.store') }}"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="space-y-6">
                    <x-form.field
                        label="Title"
                        name="title"
                        type="text"
                        placeholder="Enter an idea for title"
                        required
                        autofocus
                    />

                    <div class="space-y-4">
                        <label for="status" class="lablel">Status</label>
                        <div class="flex gap-x-4 mt-2">

                            @foreach (App\IdeaStatus::cases() as $status)
                                <button
                                    type="button"
                                    @click="status = @js($status->value)"
                                     data-test="button-status-{{ $status->value }}"
                                    class="btn flex-1 h-10"
                                    :class="{'btn-outlined': status !== @js($status->value)}"
                                >
                                    {{ $status->label() }}
                                </button>
                            @endforeach

                            <input
                                type="hidden"
                                name="status"
                                id="status"
                                x-bind:value="status"
                            />

                            <x-form.error name="status" />
                        </div>

                        <x-form.field
                            label="Description"
                            name="description"
                            type="textarea"
                            placeholder="Describe here your idea ...."
                        />

                        <div class="space-y-2">

                            <label for="image" class="label"> Featured Image </label>

                            <input
                                type="file"
                                name="image"
                                id="image"
                                accept="image/*"
                            />

                            <x-form.error name="image" />
                        </div>

                        <div>
                            <fieldset class="space-y-3">
                                <legend class="label">Actionable Steps</legend>
                                <template x-for="(step, index) in steps">
                                    <div class="flex gap-x-2 items-center">

                                        <input name="steps[]" x-model="step" class="input" />

                                        <button
                                            type="button"
                                            aria-label="Remove link"
                                            @click="steps.splice(index,1)"
                                            class="form-muted-icon"
                                        >
                                            <x-icons.close />
                                        </button>
                                    </div>
                                </template>

                                <div class="flex gap-x-2 items-center">
                                    <input
                                        x-model="newStep"
                                        id="new-step"
                                        data-test="new-step"
                                        placeholder="What needs to bed done?"
                                        class="input flex-1"
                                        spellcheck="false"
                                    />

                                    <button
                                        type="button"
                                        @click="steps.push(newStep.trim()); newStep = '';"
                                        :disabled="newStep.trim().length <= 11"
                                        class="border border-border rounded-full p-1 group cursor-pointer enabled:hover:border-green-500/30 enabled:hover:bg-green-300/20 disabled:cursor-not-allowed! enabled:hover:text-green-500/80"
                                        aria-label="Add a new link"
                                    >
                                        <x-icons.close class="rotate-45" />
                                    </button>
                                </div>
                            </fieldset>
                        </div>

                        <div>
                            <fieldset class="space-y-3">

                                <legend class="label">Links</legend>

                                <template x-for="(link, index) in links">
                                    <div class="flex gap-x-2 items-center">
                                        <input name="links[]" x-model="link" class="input" />
                                        <button type="button" aria-label="Remove link" @click="links.splice(index,1)"
                                            class="form-muted-icon">

                                            <x-icons.close />
                                        </button>
                                    </div>
                                </template>

                                <div class="flex gap-x-2 items-center">
                                    <input
                                        x-model="newLink"
                                        type="url"
                                        id="new-link"
                                        placeholder="http://example.com"
                                        autocomplete="url"
                                        class="input flex-1"
                                        spellcheck="false"
                                    />

                                    <button
                                        type="button"
                                        @click="links.push(newLink.trim()); newLink = '';"
                                        :disabled="newLink.trim().length <= 11"
                                        class="border border-border rounded-full p-1 group cursor-pointer enabled:hover:border-green-500/30 enabled:hover:bg-green-300/20 disabled:cursor-not-allowed! enabled:hover:text-green-500/80"
                                        aria-label="Add a new link"
                                    >
                                        <x-icons.close class="rotate-45" />
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-x-5 mt-4 pr-4">

                    <button
                        type="button"
                        @click="$dispatch('close-modal')"
                        class="btn btn-outlined font-bold hover:text-red-500/70 hover:font-extrabold"
                    >
                        Cancel
                    </button>

                    <button type="submit" class="btn">Create</button>
                </div>
            </form>
        </x-modal>
    </div>
</x-layout>
