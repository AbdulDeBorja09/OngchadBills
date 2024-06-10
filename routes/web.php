<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillsController;

Route::get('/', [BillsController::class, 'index'])->name('index');
Route::get('/payments', [BillsController::class, 'payments'])->name('payments');
Route::get('/history', [BillsController::class, 'history'])->name('history');
Route::get('/apartment', [BillsController::class, 'apartment'])->name('apartment');
Route::get('/submeter', [BillsController::class, 'submeter'])->name('submeter');
Route::get('/computation', [BillsController::class, 'computation'])->name('computation');
Route::get('/print', [BillsController::class, 'print'])->name('print');
Route::get('/history/{id}', [BillsController::class, 'showhistory'])->name('showhistory');
Route::get('/apartment/{id}', [BillsController::class, 'showapartment'])->name('showapartment');

Route::get('/editcompute/{id}', [BillsController::class, 'editcompute'])->name('editcompute');
Route::post('/editcompute/{id}', [BillsController::class, 'editcompute'])->name('editcompute');
Route::post('/computation', [BillsController::class, 'compute'])->name('compute');
Route::post('/submitedit', [BillsController::class, 'submitedit'])->name('submitedit');
Route::post('/submeter', [BillsController::class, 'submetersearch'])->name('submetersearch');
Route::post('/history', [BillsController::class, 'historysearch'])->name('historysearch');
Route::post('/apartment', [BillsController::class, 'apartmentsearch'])->name('apartmentsearch');
Route::post('/apartment/{id}/paid', [BillsController::class, 'paidstatus'])->name('paidstatus');
Route::post('/apartment/{id}/delete', [BillsController::class, 'delete'])->name('delete');
Route::get('/soloprint/{id}', 'App\Http\Controllers\PDFController@soloprint')->name('soloprint');
Route::post('/pdf', 'App\Http\Controllers\PDFController@generatePDF')->name('pdf');
Route::post('/computation/latest', [BillsController::class, 'getLastReading'])->name('getLastReading');
