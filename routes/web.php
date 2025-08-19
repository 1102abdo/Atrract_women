<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Database connected successfully!";
    } catch (\Exception $e) {
        return "❌ Database connection error: " . $e->getMessage();
    }
});

require __DIR__ . '/auth.php';
