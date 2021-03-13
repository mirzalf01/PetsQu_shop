<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware'=>'auth'], function(){
    Route::group(['middleware'=>'RoleAdmin'], function(){
        /* dashboard */
        /* Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard'); */
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        /* Products Action */
        Route::resource('products', ProductController::class);
    
        /* Members Action */
        Route::group(['prefix'=>'transactions'], function(){
            Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
            Route::delete('/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
        });
    
        /* Members Action */
        Route::group(['prefix'=>'members'], function(){
            Route::get('/', [MemberController::class, 'index'])->name('members.index');
            Route::delete('/{member}', [MemberController::class, 'destroy'])->name('members.destroy');
        });
    });
});

/* main site action */
Route::group(['prefix'=>'index'], function(){
    /* Show Product */
    Route::get('/', [StoreController::class, 'index'])->name('main.index');
    Route::get('/detail/{product}', [StoreController::class, 'showDetail'])->name('main.detail');
    Route::get('/search', [StoreController::class, 'search'])->name('main.search');
    

    Route::group(['middleware'=>'auth'], function(){
        Route::group(['middleware'=>'RoleMember'], function(){
            /* Cart Action */
            /* prevent user change id parameter in url */
            Route::get('/cart/{id}', [StoreController::class, 'cartDetail'])->name('main.cart')->middleware('CekUser');
            
            Route::post('/cart/{product}', [StoreController::class, 'cartStore'])->name('main.store');
            Route::put('/cart/update', [StoreController::class, 'cartUpdate'])->name('main.update');
            Route::delete('/cart/delete/{cart}', [StoreController::class, 'cartDestroy'])->name('main.destroy');
    
            /* Transaction Request Action */
            Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');

            /* Pembelian Action */
            Route::get('/pembelian', [StoreController::class, 'pembelianIndex'])->name('main.pembelian');
        });
    });

    
});
