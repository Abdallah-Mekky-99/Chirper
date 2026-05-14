@props(['model', 'type'])

<form action="{{ route('like.toggle', ['type' => $type, 'id' => $model->id]) }}" method="POST" class="m-0 p-0">
    @csrf
    @php
        $isLiked = $model->likes_exists ?? false;
    @endphp

    <button type="submit"
        class="flex items-center gap-2 hover:text-error transition-colors group/btn {{ $isLiked ? 'text-error' : '' }}">
        <div class="p-2 rounded-full group-hover/btn:bg-error/10 transition-colors {{ $isLiked ? 'bg-error/10' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                fill="{{ $isLiked ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <path
                    d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
            </svg>
        </div>
        <span class="text-xs font-medium">{{ $model->likes_count }}</span>
    </button>
</form>
