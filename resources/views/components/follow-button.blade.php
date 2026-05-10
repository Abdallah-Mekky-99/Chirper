@props(['user'])

@if (!$user->is(auth()->user()))
    <form method="POST" action="{{ route('toggle-follow', $user->id) }}" class="m-0">
        @csrf
        @if ($user->is_followed)
            {{-- Following State --}}
            <button
                class="btn btn-ghost btn-sm border-base-300 group/follow hover:border-error hover:text-error hover:bg-error/10 transition-colors"
                type="submit">
                {{-- Checkmark icon (default) --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 mr-1 group-hover/follow:hidden" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                {{-- Unfollow icon (on hover) --}}
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 mr-1 hidden group-hover/follow:block" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
                <span class="group-hover/follow:hidden">Following</span>
                <span class="hidden group-hover/follow:block">Unfollow</span>
            </button>
        @else
            {{-- Follow State --}}
            <button class="btn btn-neutral btn-sm" type="submit">Follow</button>
        @endif
    </form>
@endif
