<?php

use Illuminate\Support\Facades\Route;

Route::get('/department', function () {
    return 'Here test route of department with quiz';
});

Route::get('/department/{id}', function ($id) {
    return "Department with quiz details for ID: $id";
});
