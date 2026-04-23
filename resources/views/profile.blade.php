<x-layout>
    <x-slot:title>
        {{ $user->name }}'s profile
    </x-slot:title>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex items-center gap-6 mb-8">
           <x-user-avatar :user="$user" size="size-24"/>
            <div>
                <h1 class="text-3xl font-bold text-base-content">{{ $user->name }}</h1>
                <p class="text-sm text-base-content/60 flex items-center gap-1 mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Joined {{ $user->created_at->format('F Y') }}
                </p>
            </div>
        </div>

        <div class="tabs tabs-bordered mb-6">
            <a class="tab tab-active font-semibold">Chirps</a>
            <a class="tab text-base-content/40 cursor-not-allowed">Media</a>
            <a class="tab text-base-content/40 cursor-not-allowed">Likes</a>
        </div>

        <div class="space-y-4">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp"/>
            @empty
                <div class="text-center py-12 bg-base-200/30 rounded-xl border border-dashed border-base-300">
                    <p class="text-base-content/50 italic">This user hasn't chirped anything yet...</p>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>