<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\WithdrawController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('login', function () {
    abort(401);
})->name('login');



Route::post('login', function () {
    $credentials = request()->only(['email', 'password']);
    if (!auth()->validate($credentials)) {
        abort(401);
    } else {
        $user = User::where('email', $credentials['email'])->first();
        $token = $user->createToken('clicknext');

        return response()->json(['status' => 'success', 'token' => $token->plainTextToken]);
    }
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/process/withdraw', [WithdrawController::class, 'withdraw']);
    
    Route::post('/get/account-data', [AccountController::class, 'getAccountData']);
});
