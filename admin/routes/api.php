<?php

use App\Http\Controllers\Api\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

Route::post('/api/login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // return fake token for example purposes
    return response()->json([
        'token' => 'fake-jwt-token',
        'user' => $user
    ]);
});

Route::get('/api/quiz-questions', [QuizController::class, 'index']);
Route::get('/api/test', function () {
    return response()->json(['message' => 'API is working']);
});



