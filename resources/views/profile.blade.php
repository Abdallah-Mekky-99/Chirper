<x-layout>
    <x-slot:title>
        {{ $user->name }}'s profile
    </x-slot:title>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="flex items-start justify-between mb-8">
            <div class="flex items-center gap-6">
                <x-user-avatar :user="$user" size="size-24" />
                <div>
                    <h1 class="text-3xl font-bold text-base-content">{{ $user->name }}</h1>
                    <p class="text-sm text-base-content/60 flex items-center gap-1 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Joined {{ $user->created_at->format('F Y') }}
                    </p>
                    <div class="flex items-center gap-4 mt-3">
                        <button onclick="following_modal.showModal()" class="hover:underline text-sm focus:outline-none">
                            <span class="font-bold text-base-content">{{ $user->followings_count }}</span>
                            <span class="text-base-content/60">Following</span>
                        </button>
                        <button onclick="followers_modal.showModal()" class="hover:underline text-sm focus:outline-none">
                            <span class="font-bold text-base-content">{{ $user->followers_count }}</span>
                            <span class="text-base-content/60">Followers</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <x-follow-button :user="$user" />
            </div>
        </div>

        <div class="tabs tabs-bordered mb-6">
            <a class="tab tab-active font-semibold">Chirps</a>
            <a class="tab text-base-content/40 cursor-not-allowed">Media</a>
            <a class="tab text-base-content/40 cursor-not-allowed">Likes</a>
        </div>

        <div class="space-y-4">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" :show-follow="false" />
            @empty
                <div class="text-center py-12 bg-base-200/30 rounded-xl border border-dashed border-base-300">
                    <p class="text-base-content/50 italic">This user hasn't chirped anything yet...</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Following Modal -->
    <dialog id="following_modal" class="modal">
        <div class="modal-box max-w-sm">
            <h3 class="font-bold text-lg mb-4">Following</h3>
            <div class="space-y-2 max-h-96 overflow-y-auto pr-2">
                <!-- Placeholder loop, replace with real data -->
                @forelse ($user->followings as $following)
                    <div
                        class="flex items-center gap-3 p-2 hover:bg-base-200/50 rounded-xl transition-colors cursor-pointer">
                        <div class="avatar">
                            <x-user-avatar :user="$following" size="size-8" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-sm truncate text-base-content">{{ $following->name }} </h4>
                        </div>
                        <x-follow-button :user="$following" />
                    </div>
                @empty
                    No Followings yet.
                @endforelse
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm">Close</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <!-- Followers Modal -->
    <dialog id="followers_modal" class="modal">
        <div class="modal-box max-w-sm">
            <h3 class="font-bold text-lg mb-4">Followers</h3>
            <div class="space-y-2 max-h-96 overflow-y-auto pr-2">
                <!-- Placeholder loop, replace with real data -->
                @forelse ($user->followers as $follower)
                    <div
                        class="flex items-center gap-3 p-2 hover:bg-base-200/50 rounded-xl transition-colors cursor-pointer">
                        <div class="avatar">
                            <x-user-avatar :user="$follower" size="size-8" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-sm truncate text-base-content">{{ $follower->name }}</h4>
                        </div>
                        <x-follow-button :user="$follower" />
                    </div>
                @empty
                    No Followers yet.
                @endforelse
            </div>
            <div class="modal-action">
                <form method="dialog">
                    <button class="btn btn-sm">Close</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>
</x-layout>
