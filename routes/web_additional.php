<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PlatoController;

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/pdf', [ReportController::class, 'generatePdf'])->name('reports.pdf');
// Route::get('/reports/excel', [ReportController::class, 'generateExcel'])->name('reports.excel');

Route::post('/chef/plato/{id}/updateCantidad', [PlatoController::class, 'updateCantidad'])->name('chef.plato.updateCantidad');
