<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\InboxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return "Welcome To Whatsapp API BPS";
});

Route::get('/register', [AccessController::class, 'create']);

Route::middleware('access')->group(function () {
    Route::get('/inbox', [InboxController::class, 'index']);
    Route::post('/inbox', [InboxController::class, 'create']);
    Route::put('/inbox/{id}', [InboxController::class, 'update']);
});
