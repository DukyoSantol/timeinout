<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeRecordController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Time record routes (protected)
Route::middleware('auth')->group(function () {
    Route::get('/time-in-out', [TimeRecordController::class, 'create'])->name('time-records.form');
    Route::get('/time-in-out-simple', function() {
        return view('time-records.form_simple');
    })->name('time-records.form-simple');
    Route::get('/test-minimal', function() {
        return view('time-records.test_minimal');
    })->name('time-records.test-minimal');
    Route::get('/test-isolated', function() {
        return view('time-records.test_isolated');
    })->name('time-records.test-isolated');
    Route::get('/test-form', function() {
        return view('test_form');
    })->name('test.form');
    Route::get('/test-simple', function() {
        return view('test_simple');
    })->name('test.simple');
    Route::get('/time-test', function() {
        return view('time_test');
    })->name('time.test');
    Route::get('/simple-time-test', function() {
        return view('simple_time_test');
    })->name('simple.time.test');
    Route::post('/time-records', [TimeRecordController::class, 'store'])->name('time-records.store');
    Route::post('/time-records/time-out-user', [TimeRecordController::class, 'timeOutUser'])->name('time-records.time-out-user');
    Route::post('/check-timed-in-status', [TimeRecordController::class, 'checkTimedInStatus'])->name('time-records.check-timed-in-status');
    Route::get('/time-records/get-current-time', [TimeRecordController::class, 'getCurrentTime'])->name('time-records.get-current-time');
});

// Admin routes (protected + admin check)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [TimeRecordController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/export', [TimeRecordController::class, 'exportTimeRecords'])->name('admin.export');
    Route::get('/test-export', [TimeRecordController::class, 'exportTimeRecords'])->name('admin.test.export');
    Route::get('/simple-export', [TimeRecordController::class, 'simpleExport'])->name('admin.simple.export');
    Route::get('/view-csv', [TimeRecordController::class, 'viewCsv'])->name('admin.view.csv');
    Route::post('/store-export-filters', [TimeRecordController::class, 'storeExportFilters'])->name('admin.store.export.filters');
    
    // Debug test route
    Route::get('/debug-params', function(Request $request) {
        \Log::info('=== DEBUG ROUTE ===');
        \Log::info('URL: ' . $request->fullUrl());
        \Log::info('Query: ' . $request->getQueryString());
        \Log::info('All params: ' . json_encode($request->all()));
        return response()->json([
            'url' => $request->fullUrl(),
            'query' => $request->getQueryString(),
            'params' => $request->all()
        ]);
    })->name('admin.debug.params');
    Route::delete('/time-records/{id}', [TimeRecordController::class, 'deleteRecord'])->name('admin.time-records.delete');
    Route::get('/users', [TimeRecordController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('/users/create', [TimeRecordController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [TimeRecordController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [TimeRecordController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [TimeRecordController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [TimeRecordController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/users/export', [TimeRecordController::class, 'exportUsers'])->name('admin.users.export');
    Route::get('/time-records', [TimeRecordController::class, 'timeRecordsIndex'])->name('admin.time-records.index');
    Route::get('/time-records/{id}/edit', [TimeRecordController::class, 'edit'])->name('admin.time-records.edit');
    Route::put('/time-records/{id}', [TimeRecordController::class, 'update'])->name('admin.time-records.update');
    Route::delete('/time-records/{id}', [TimeRecordController::class, 'destroy'])->name('admin.time-records.destroy');
    Route::post('/time-records/{id}/time-out', [TimeRecordController::class, 'timeOut'])->name('admin.time-records.time-out');
    Route::get('/filter', [TimeRecordController::class, 'filter'])->name('admin.time-records.filter');
    Route::get('/users/{id}/change-password', [TimeRecordController::class, 'showChangePasswordForm'])->name('admin.users.change-password');
    Route::post('/users/{id}/change-password', [TimeRecordController::class, 'changePassword'])->name('admin.users.change-password.post');
});
