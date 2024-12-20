<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::get('/', function () {
    return redirect()->route('issues.index');
});

// Các route liên quan đến Issues
Route::get('/issues', [IssueController::class, 'index'])->name('issues.index');
Route::get('/issues/create', [IssueController::class, 'create'])->name('issues.create');
Route::post('/issues', [IssueController::class, 'store'])->name('issues.store');
Route::get('/issues/{id}/edit', [IssueController::class, 'edit'])->name('issues.edit');
Route::put('/issues/{id}', [IssueController::class, 'update'])->name('issues.update');
Route::delete('/issues/{id}', [IssueController::class, 'destroy'])->name('issues.destroy');

