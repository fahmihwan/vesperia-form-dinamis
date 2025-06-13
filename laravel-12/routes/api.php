<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormDesignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/forms', [FormController::class, 'getListForms']);
Route::post('/form', [FormController::class, 'storeForm']);
Route::get('/forms/{id}', [FormController::class, 'showForm']);
Route::put('/form/{id}', [FormController::class, 'updateForm']);
Route::delete('/form/{id}', [FormController::class, 'destroyForm']);



Route::get('/form-dinamis', [FormController::class, 'getFormDinamis']);
Route::get('/form-dinamis/{id}', [FormController::class, 'showFormDinamsDetail']);
Route::post('/form-design', [FormDesignController::class, 'storeDesign']);
Route::delete('/form-design/{id}', [FormDesignController::class, 'deleteDesign']);


Route::post('/form-answer', [FormController::class, 'answerForm']);

// answerForm
// Route::get("/tes",function (){
//     return "kwkw";
// });