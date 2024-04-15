<?php

use App\Http\Controllers\GenerateContractTemplatePdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('generate-contract-template-pdf/{id}', GenerateContractTemplatePdfController::class)
    ->name('generate-contract-template-pdf');
