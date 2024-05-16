<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AdminController::class, "login"])->name("login");
Route::post('/login', [AdminController::class, "post_login"])->name("post_login");



Route::group(['middleware' => ['AdminMiddleware']], function () {
    Route::get('/logout', [AdminController::class, "logout"])->name("logout");
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name("dashboard");


    Route::prefix('karyawan')->group(function () {
        $x = "karyawan";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('project')->group(function () {
        $x = "project";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('uangMasuk')->group(function () {
        $x = "uangMasuk";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('material')->group(function () {
        $x = "material";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('jasa')->group(function () {
        $x = "jasa";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('pinjaman')->group(function () {
        $x = "pinjaman";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('laporan')->group(function () {
        $x = "laporan";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::get('/detail/{id}', [AdminController::class, "detail_$x"])->name("detail_$x");
    });

    Route::prefix('grupLap')->group(function () {
        $x = "grupLap";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });


});
