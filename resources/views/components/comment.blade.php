@props(['comment'])

<div class="flex gap-3 group">
    {{-- Avatar Column --}}
    <div class="shrink-0 mt-1">
        {{-- TODO: Pass the comment's user relation here (e.g., $comment->user) --}}
        <x-user-avatar :user="$comment->user" size="size-8" />
    </div>

    {{-- Comment Body Column --}}
    <div class="flex-1 min-w-0">
        <div
            class="bg-base-200 rounded-2xl rounded-tl-none px-4 py-3 relative border border-base-300/50 shadow-sm transition-colors hover:bg-base-300/50">
            {{-- Header Area --}}
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-2 flex-wrap leading-tight">
                    {{-- TODO: Bind the comment's author name here (e.g., $comment->user->name) --}}
                    <a href="{{ route('profile.show', $comment->user_id) }}"
                        class="font-bold text-[14px] hover:underline text-base-content">
                        {{ $comment->user->name }}
                    </a>

                    <div class="text-[12px] text-base-content/60">
                        <span>·</span>
                        {{-- TODO: Bind the comment's created_at diffForHumans here (e.g., $comment->created_at->diffForHumans()) --}}
                        <span class="ml-1"
                            title="{{ $comment->created_at }}">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>

                    @if ($comment->updated_at->gt($comment->created_at->addSeconds(5)))
                        <span
                            class="text-[11px] px-2 py-0.5 bg-base-200 rounded-full text-base-content/60 italic font-medium">edited</span>
                    @endif
                </div>

                {{-- Dropdown for Edit/Delete --}}
                @canany(['update', 'delete'], $comment)
                    <div class="dropdown dropdown-end shrink-0 -mt-1 -mr-2">
                        <button tabindex="0"
                            class="btn btn-ghost btn-sm btn-circle text-base-content/50 hover:text-base-content transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="1" />
                                <circle cx="19" cy="12" r="1" />
                                <circle cx="5" cy="12" r="1" />
                            </svg>
                        </button>
                        <ul tabindex="0"
                            class="dropdown-content z-1 menu p-2 shadow-xl bg-base-100 rounded-box w-52 border border-base-200">
                            @can('update', $comment)
                                <li>
                                    <button type="button"
                                        onclick="document.getElementById('comment-text-{{ $comment->id }}').classList.add('hidden'); document.getElementById('comment-edit-form-{{ $comment->id }}').classList.remove('hidden');"
                                        class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12 22h6a2 2 0 0 0 2-2V7l-5-5H6a2 2 0 0 0-2 2v10" />
                                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                                            <path d="M10.4 12.6a2 2 0 1 1 3 3L8 21l-4 1 1-4Z" />
                                        </svg>
                                        Edit
                                    </button>
                                </li>
                            @endcan
                            @can('delete', $comment)
                                <li>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                        class="w-full m-0 p-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this comment?')"
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
                            @endcan
                        </ul>
                    </div>
                @endcanany
            </div>

            {{-- Message Body (View Mode) --}}
            <p id="comment-text-{{ $comment->id }}"
                class="mt-1 text-[14px] leading-relaxed text-base-content wrap-break-word">
                {{ $comment->content }}
            </p>

            {{-- Message Body (Edit Mode) --}}
            @can('update', $comment)
                <form id="comment-edit-form-{{ $comment->id }}" action="{{ route('comments.update', $comment->id) }}"
                    method="POST" class="hidden mt-2">
                    @csrf
                    @method('PATCH')
                    <textarea name="content" rows="2"
                        class="textarea textarea-bordered w-full rounded-xl bg-base-100 focus:bg-base-100 transition-colors border-none resize-none min-h-0 py-2 text-[14px] leading-relaxed"
                        required>{{ $comment->content }}</textarea>
                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button"
                            onclick="document.getElementById('comment-edit-form-{{ $comment->id }}').classList.add('hidden'); document.getElementById('comment-text-{{ $comment->id }}').classList.remove('hidden');"
                            class="btn btn-ghost btn-sm rounded-full">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm rounded-full px-4">Save</button>
                    </div>
                </form>
            @endcan
        </div>

        {{-- Optional Interaction (Like/Reply for comments) --}}
        {{-- <div class="flex gap-4 mt-1 ml-2">
            <button class="text-[12px] font-medium text-base-content/60 hover:text-base-content transition-colors">Like</button>
            <button class="text-[12px] font-medium text-base-content/60 hover:text-base-content transition-colors">Reply</button>
        </div> --}}
    </div>
</div>
