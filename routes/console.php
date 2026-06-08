<?php

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test', function () {

    $value = User::factory(3)->create();
    // dump($value->attributesToArray());

    foreach ($value as $user)
        dump($user->attributesToArray());
});
