@props(['name', 'label', 'placeholder', 'type' => 'text'])

<div class="flex flex-col mb-5">
    <label class="floating-label">
        <input type="{{ $type }}" name="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name) }}"
            class="input input-bordered @error($name) input-error @enderror" required>
        <span>{{ $label }}</span>
    </label>

    @error( $name )
        <div class="px-1 pt-1"> <span class="label-text-alt text-error font-medium">{{ $message }}</span>
        </div>
    @enderror
</div>
