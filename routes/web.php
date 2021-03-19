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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return redirect('web/dashboard');
    });

    Route::get('/web/dashboard', \App\View\Web\Dashboard::class);
    Route::get('/web/articles', \App\View\Web\Articles::class);
    Route::get('/web/pages', \App\View\Web\Pages::class);
    Route::get('/web/events', \App\View\Web\Events::class);
    Route::get('/web/web-content', \App\View\Web\WebContent::class);
    Route::get('/web/settings/{page}', \App\View\Web\Settings::class);
  
    Route::get('/web/page/{page}/{lang?}', \App\View\Web\ContentForm::class);
    Route::get('/web/content/{group}/{lang?}', \App\View\Web\ContentForm::class);

    Route::get('/web/users', \App\View\User\Users::class);
    Route::get('/web/user-profile', \App\View\User\Profile::class);

    Route::get('/eshop/dashboard', \App\View\Eshop\Dashboard::class);
    Route::get('/eshop/orders', \App\View\Eshop\Orders::class);
    Route::get('/eshop/products', \App\View\Eshop\Products::class);
    Route::get('/eshop/carts', \App\View\Eshop\Carts::class);
    Route::get('/eshop/settings/{page}', \App\View\Eshop\Settings::class);

    Route::get('/{section}/{parent}s/{method}/{uid?}', \App\View\Form\RecordForm::class);
 
    Route::get('invoice/generate/{id}', [\App\Http\Controllers\InvoiceController::class, 'generate']);

    Route::get('xml/google-shoping', [\App\Http\Controllers\XmlController::class, 'googleShoping']);
    Route::get('xml/zbozi-cz', [\App\Http\Controllers\XmlController::class, 'zboziCz']);
    Route::get('xml/heureka', [\App\Http\Controllers\XmlController::class, 'heureka']);
    Route::get('xml/glami', [\App\Http\Controllers\XmlController::class, 'glami']);
});

Route::get('invoice/show/{id}', [\App\Http\Controllers\InvoiceController::class, 'show']);

require __DIR__.'/auth.php';
