<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', function () {
        return redirect('web/dashboard');
    });
    
    Route::get('/web/dashboard', \App\Http\Livewire\Web\Dashboard::class)->name('web.dashboard');
    Route::get('/web/articles', \App\Http\Livewire\Web\Articles::class);
    Route::get('/web/pages', \App\Http\Livewire\Web\Pages::class);
    Route::get('/web/subpages', \App\Http\Livewire\Web\Subpages::class);
    Route::get('/web/contacts', \App\Http\Livewire\Web\Contacts::class);
    Route::get('/web/settings/{page}', \App\Http\Livewire\Web\Settings::class);

    Route::get('/eshop/dashboard', \App\Http\Livewire\Eshop\Dashboard::class);
    Route::get('/eshop/orders', \App\Http\Livewire\Eshop\Orders::class);
    Route::get('/eshop/products', \App\Http\Livewire\Eshop\Products::class);
    Route::get('/eshop/carts', \App\Http\Livewire\Eshop\Carts::class);
    Route::get('/eshop/settings/{page}', \App\Http\Livewire\Eshop\Settings::class);

    Route::get('/web/article/{method}/{uid?}', \App\Http\Livewire\Form\Article::class);
    Route::get('/web/subpage/{method}/{uid?}', \App\Http\Livewire\Form\Subpage::class);
    Route::get('/eshop/product/{method}/{uid?}', \App\Http\Livewire\Form\Product::class);

    Route::get('/content/{post}/{version}', \App\Http\Livewire\Content\Visual::class);

    Route::get('/web/users', \App\Http\Livewire\User\Users::class);
    Route::get('/user/profile', \App\Http\Livewire\User\Profile::class)->name('profile.show');

    Route::get('invoice/generate/{id}', [\App\Http\Controllers\InvoiceController::class, 'generate']);
});

Route::get('invoice/show/{id}', [\App\Http\Controllers\InvoiceController::class, 'show']);