@props(['chirp', 'showFollow' => true])

<div class="bg-base-100 rounded-2xl border border-base-200 p-5 hover:bg-base-200/40 transition-colors group shadow-sm">
    <div class="flex gap-4">
        <div class="shrink-0">
            <x-user-avatar :user="$chirp->user" size="size-12" />
        </div>

        <div class="flex-1 min-w-0">
            {{-- Header Area --}}
            <div class="flex items-start justify-between">
                <div class="flex flex-col leading-tight mt-0.5">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('profile.show', $chirp->user->id) }}"
                            class="font-bold text-[16px] hover:underline">
                            {{ $chirp->user ? $chirp->user->name : 'Anonymous' }}
                        </a>
                        @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                            <span
                                class="text-[11px] px-2 py-0.5 bg-base-200 rounded-full text-base-content/60 italic font-medium">edited</span>
                        @endif
                    </div>

                    <div class="text-[13px] text-base-content/60 mt-0.5">
                        <span title="{{ $chirp->created_at }}">{{ $chirp->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    @if ($showFollow)
                        <x-follow-button :user="$chirp->user" />
                    @endif

                    @can('update', $chirp)
                        <div class="dropdown dropdown-end shrink-0">
                            <button tabindex="0"
                                class="btn btn-ghost btn-sm btn-circle text-base-content/70 hover:text-base-content transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <circle cx="12" cy="12" r="3" />
                                    <circle cx="12" cy="4" r="3" />
                                    <circle cx="12" cy="20" r="3" />
                                </svg>
                            </button>
                            <ul tabindex="0"
                                class="dropdown-content z-1 menu p-2 shadow-xl bg-base-100 rounded-box w-52 border border-base-200">
                                <li>
                                    <a href="{{ route('chirps.edit', $chirp->id) }}" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v10" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                            <path d="M10.4 12.6a2 2 0 1 1 3 3L8 21l-4 1 1-4Z" />
                                        </svg>
                                        Edit
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('chirps.destroy', $chirp->id) }}" method="POST"
                                        class="w-full m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this post?')"
                                            class="w-full text-left text-error hover:bg-error/10 hover:text-error px-4 py-2 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- Message Body --}}
            <p class="mt-2 text-[15px] leading-relaxed text-base-content wrap-break-word">
                {{ $chirp->message }}
            </p>

            {{-- Interaction Icons --}}
            <div class="flex items-center justify-between mt-4 max-w-md text-base-content/60">
                {{-- Reply / Comment Button --}}
                <button type="button"
                    onclick="document.getElementById('comments-{{ $chirp->id }}').classList.toggle('hidden')"
                    class="flex items-center gap-2 hover:text-primary transition-colors group/btn cursor-pointer">
                    <div class="p-2 rounded-full group-hover/btn:bg-primary/10 transition-colors -ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                    </div>
                    {{-- Optional: Show comments count here --}}
                    <span class="text-xs font-medium">{{ $chirp->comments_count }}</span>
                </button>
                <button class="flex items-center gap-2 hover:text-success transition-colors group/btn">
                    <div class="p-2 rounded-full group-hover/btn:bg-success/10 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m17 2 4 4-4 4" />
                            <path d="M3 11v-1a4 4 0 0 1 4-4h14" />
                            <path d="m7 22-4-4 4-4" />
                            <path d="M21 13v1a4 4 0 0 1-4 4H3" />
                        </svg>
                    </div>
                </button>
                <form action="{{ route('like.store', $chirp->id) }}" method="POST" class="m-0 p-0">
                    @csrf

                    {{-- TODO: Replace 'false' with your actual condition to check if the user liked this chirp --}}
                    @php
                        $isLiked = $chirp->likes_exists;
                    @endphp

                    {{-- Hint: If you make this a toggle (like/unlike), you can keep it as POST. --}}
                    <button type="submit"
                        class="flex items-center gap-2 hover:text-error transition-colors group/btn {{ $isLiked ? 'text-error' : '' }}">
                        <div
                            class="p-2 rounded-full group-hover/btn:bg-error/10 transition-colors {{ $isLiked ? 'bg-error/10' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="{{ $isLiked ? 'currentColor' : 'none' }}"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                            </svg>
                        </div>
                        {{-- Optional: Add a dynamic like count here next to the heart --}}
                        <span class="text-xs font-medium">{{ $chirp->likes_count }}</span>
                    </button>
                </form>
                <button class="flex items-center gap-2 hover:text-primary transition-colors group/btn">
                    <div class="p-2 rounded-full group-hover/btn:bg-primary/10 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                            <polyline points="16 6 12 2 8 6" />
                            <line x1="12" x2="12" y1="2" y2="15" />
                        </svg>
                    </div>
                </button>
            </div>

            {{-- Comments Section (Toggleable) --}}
            <div id="comments-{{ $chirp->id }}" class="hidden mt-4 pt-4 border-t border-base-200">
                @auth
                    <form method="POST" action="{{ route('comments.store', $chirp->id) }}"
                        class="flex gap-3 items-start">
                        @csrf
                        {{-- Shows the currently logged-in user's avatar next to the input --}}
                        <div class="shrink-0 mt-1">
                            <x-user-avatar :user="auth()->user()" size="size-8" />
                        </div>

                        <div class="flex-1 flex flex-col items-end gap-2">
                            <textarea name="content" rows="2" maxlength="255"
                                class="textarea textarea-bordered w-full rounded-2xl bg-base-200/50 focus:bg-base-100 transition-colors border-none resize-none min-h-0 py-3"
                                placeholder="Post your reply" required></textarea>

                            <button type="submit" class="btn btn-primary btn-sm rounded-full px-6 font-bold">
                                Reply
                            </button>
                        </div>
                    </form>
                @else
                    <div class="text-center py-4 bg-base-200/50 rounded-xl mb-4">
                        <p class="text-sm text-base-content/60">Please <a href="{{ route('login') }}"
                                class="link link-primary font-bold">log in</a> to join the conversation.</p>
                    </div>
                @endauth

                {{-- The list of actual comments will go here --}}
                <div class="space-y-4 mt-2">
                    @forelse ($chirp->comments as $comment)
                        <x-comment :comment="$comment" />
                    @empty
                        <p>No comments yet.</p>
                    @endforelse
                    {{-- @foreach ($chirp->comments as $comment) ... @endforeach --}}
                </div>
            </div>

        </div>
    </div>
</div>
