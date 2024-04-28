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
Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});
Route::controller(\App\Http\Controllers\AuthController::class)->group(function(){
    Route::get('/login', function(){ return view('pages.auth.login'); })->name('login');
    Route::post('/login', 'login_process')->name('post.login');
    Route::get('/register', function(){ return view('pages.auth.register'); })->name('register');
    Route::post('/register', 'register_process')->name('post.register');
    Route::get('/email/verify', function () { return view('pages.auth.email-verification'); })->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verification_email')->name('verification.verify');
    Route::get('/forgot-password', function(){ return view('pages.auth.forgot-password'); })->name('forgot-password');
});

Route::controller(\App\Http\Controllers\AuthSSOController::class)->prefix('/oauth')->name('oauth.')->group(function(){
    Route::get('/{driver}/register', 'redirect_register')->name('register');
    Route::get('/{driver}/login', 'redirect_login')->name('login');
    Route::get('/{driver}/callback', 'callback');
    Route::get('/{driver}/callback-register', 'callback_register');
});

Route::middleware(['auth', 'verified'])->group(function(){
    Route::prefix('/administrator')->name('admin.')->middleware(['admin-login'])->group(function(){
        Route::controller(\App\Http\Controllers\Admin\DashboardController::class)->group(function(){
            Route::get('/home', 'home')->name('home');
        });

        // clear
        Route::prefix('/user/{role}')->name('user.')->group(function(){
            Route::resource('/', \App\Http\Controllers\Admin\UserController::class);
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('edit');
            Route::put('/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
            Route::delete('/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('destroy');
        });

        // clear
        Route::name('menu-access.')->group(function(){
            Route::resource('/menu-access', \App\Http\Controllers\Admin\MenuAccessController::class);
        });

        // clear
        Route::prefix('profile')->name('profile.')->group(function(){
            Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\ProfileController::class, 'save'])->name('save');
        });

        // clear
        Route::prefix('setting')->name('setting.')->group(function(){
            Route::get('/', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Admin\SettingController::class, 'save'])->name('save');
        });
    });
    Route::prefix('/user')->name('user.')->middleware(['user-login'])->group(function(){
        Route::controller(\App\Http\Controllers\User\DashboardController::class)->group(function(){
            Route::get('/home', 'home')->name('home');
        });

        // clear
        Route::name('sus.')->group(function(){
            Route::prefix('/sus-data')->group(function(){
                Route::controller(\App\Http\Controllers\User\SUS\DataController::class)->name('data.')->group(function(){
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'create')->name('create');
                    Route::get('/json', 'json')->name('json');
                    Route::get('/delete', 'delete')->name('delete');
                });
            });
            Route::prefix('/sus-documentation')->group(function(){
                Route::controller(\App\Http\Controllers\User\SUS\DocumentationController::class)->name('documentation.')->group(function(){
                    Route::get('/', 'index')->name('index');
                });
            });
        });

        // clear
        Route::name('ueq.')->group(function(){
            Route::prefix('/ueq-data')->group(function(){
                Route::controller(\App\Http\Controllers\User\UEQ\DataController::class)->name('data.')->group(function(){
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'create')->name('create');
                    Route::get('/json', 'json')->name('json');
                    Route::get('/delete', 'delete')->name('delete');
                });
            });
            Route::prefix('/ueq-result')->group(function(){
                Route::controller(\App\Http\Controllers\User\UEQ\ResultController::class)->name('result.')->group(function(){
                    Route::get('/', 'index')->name('index');
                });
            });
            Route::prefix('/ueq-documentation')->group(function(){
                Route::controller(\App\Http\Controllers\User\UEQ\DocumentationController::class)->name('documentation.')->group(function(){
                    Route::get('/', 'index')->name('index');
                });
            });
        });

        Route::resource('/validity-and-reliability-item', \App\Http\Controllers\User\ValidityReliability\ItemController::class);
        Route::name('validandreliable.')->group(function(){
            Route::prefix('/validity-and-reliability-data')->group(function(){
                Route::controller(\App\Http\Controllers\User\ValidityReliability\DataController::class)->name('data.')->group(function(){
                    Route::get('/', 'index')->name('index');
                    Route::post('/', 'create')->name('create');
                    Route::get('/json', 'json')->name('json');
                    Route::get('/delete', 'delete')->name('delete');
                });
            });
        });

        // clear
        Route::prefix('profile')->name('profile.')->group(function(){
            Route::get('/', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\ProfileController::class, 'save'])->name('save');
        });
    });

    Route::controller(\App\Http\Controllers\AuthController::class)->group(function(){
        Route::get('/logout', 'logout')->name('logout');
    });
});
