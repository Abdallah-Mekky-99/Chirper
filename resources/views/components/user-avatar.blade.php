@props(['user', 'size' => 'size-10'])

@if ($user)
    <div class="avatar">
        <div class="{{ $size }} rounded-full">
            <img src="https://avatars.laravel.cloud/{{ urlencode($user->email) }}"
                alt="{{ $user->name }}'s avatar" class="rounded-full" />
        </div>
    </div>
@else
    <div class="avatar placeholder">
        <div class="{{ $size }} rounded-full">
            <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                alt="Anonymous User" class="rounded-full" />
        </div>
    </div>
@endif
