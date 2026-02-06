<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => view('login'));
Route::get('/companies', fn() => view('companies'));
Route::get('/companies/{company}/contacts', function(\App\Models\Company $company) {
    return view('contacts', compact('company'));
});
