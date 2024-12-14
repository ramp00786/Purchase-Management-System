<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\api\PurchaseOrderController;
use App\Http\Controllers\Api\SupplierController;

// get details for create order
Route::apiResource('products', ProductController::class);
Route::apiResource('suppliers', SupplierController::class);
// submit purchase
Route::post('/submit-purchase', [PurchaseOrderController::class, 'submit_purchase']);
// Route to fetch purchase details (invoice)
Route::get('/purchase/{id}', [PurchaseOrderController::class, 'getInvoice']);
// get all orders
Route::get('/purchase', [PurchaseOrderController::class, 'getAllPurchase']);


