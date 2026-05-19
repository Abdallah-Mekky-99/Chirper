@props(['model', 'type'])

@php
    $isLiked = $model->likes_exists ?? false;
@endphp

<div x-data="{
        isLiked: {{ $isLiked ? 'true' : 'false' }},
        count: {{ $model->likes_count }},
        isLoading: false,
        async toggleLike() {
            // Prevent spam-clicking while the request is happening
            if (this.isLoading) return; 
            this.isLoading = true;

            try {
                let res = await fetch('{{ route('like.toggle', ['type' => $type, 'id' => $model->id]) }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
                });
                
                // If the server returns 400, 404, 500, etc., throw an error and DO NOT update UI
                if (!res.ok) {
                    throw new Error('Server returned ' + res.status);
                }

                let data = await res.json();
                
                // Only update the UI if the server explicitly returned the new count
                if (data.likes_count !== undefined) {
                    this.count = data.likes_count;
                    this.isLiked = !this.isLiked; 
                }
            } catch (error) {
                console.error('Failed to toggle like:', error);
                alert('Something went wrong. Please try again.');
            } finally {
                // Always unlock the button when finished
                this.isLoading = false; 
            }
        }
    }">
    
    <button type="button" @click="toggleLike"
        :disabled="isLoading"
        :class="isLiked ? 'text-error' : ''"
        class="flex items-center gap-2 hover:text-error transition-colors group/btn disabled:opacity-50">
        
        <div :class="isLiked ? 'bg-error/10' : ''" 
             class="p-2 rounded-full group-hover/btn:bg-error/10 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                :fill="isLiked ? 'currentColor' : 'none'" 
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
            </svg>
        </div>
        
        <span class="text-xs font-medium" x-text="count"></span>
    </button>
</div>
