<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BudgetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // For tracker expense
    // Route::get('/', [BudgetController::class, 'index'])->name('home');
    Route::post('/add-budget', [BudgetController::class, 'addBudget'])->name('add-budget');
    Route::post('/add-expense', [BudgetController::class, 'addExpense'])->name('add-expense');
    Route::delete('/delete-expense/{id}', [BudgetController::class, 'deleteExpense'])->name('delete-expense');
    Route::post('/reset', [BudgetController::class, 'resetAll'])->name('reset');

});


require __DIR__.'/auth.php';
