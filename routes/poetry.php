<?php

use Illuminate\Support\Facades\Route;

Route::get('/poems', function () {
    return 'List of poems';
});

Route::get('/poems/{id}', function ($id) {
    return "Poem details for ID: $id";
});
