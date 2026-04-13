<x-layout>
    <x-slot:title> 
        Quotes
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Quotes</h1>

        <!-- the form -->
         <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="/Add-quote">
                    @csrf
                    <div class="form-control w-full">
                        <textarea
                            name="quote"
                            placeholder="What's on your mind?"
                            class="textarea textarea-bordered w-full resize-none"
                            rows="4"
                            required
                            maxlength="99"
                        >{{ old('quote') }}</textarea>
                        @error('quote')
                            <div class="label">
                                <span class="label-text-alt text-error"> {{ $message }} </span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Quote
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-4 mt-8">
            @forelse ($quotes as $quote)
                <x-quote :quote="$quote"/>
            @empty
                <p class="text-gray-500">No Quotes yet. Add your first</p>
            @endforelse
        </div>
    </div>
</x-layout>
