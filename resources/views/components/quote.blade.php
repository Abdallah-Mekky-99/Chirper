@props(['quote'])

<div class="card bg-base-100 shadow mt-8">
    <div class="card-body">
        <div>
            <div class="mt-1">{{ $quote->text }}</div>
        </div>
    </div>
</div>
