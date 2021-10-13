<?php

use App\Http\Controllers\ShippedItemsController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\processesController;
use App\Http\Controllers\retailCenterController;
use App\Http\Controllers\transportationEventController;
use App\Models\ShippedItems;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page
Route::get('/', [homeController::class, 'displayHomePage']);

// Shipped items display page
Route::get('/shipped-items', [ShippedItemsController::class, 'displayShippedItems']);

// Display form for shipped Items submission
Route::get('/shipped-items/insert', [ShippedItemsController::class, 'insertShippedItems']);

// Insert shipped item 
Route::post('/shipped-items/insert', [ShippedItemsController::class, 'submitShippedItems']);

// Shipped items delete request
Route::get('/shipped-items/delete/{itemNumber}', [ShippedItemsController::class, 'deleteShippedItems']);

// Request to redirect to shipped items update page
Route::get('/shipped-items/update/{itemNumber}', [ShippedItemsController::class, 'viewShippedItem']);

// Form submit updated shipped items
Route::post('/shipped-items/update/{itemNumber}/submit', [ShippedItemsController::class, 'updateShippedItem']);

// Retail center display page
Route::get('/retail-center', [retailCenterController::class, 'displayRetailCenter']);

// Display form for retail center submission
Route::get('/retail-center/insert', [retailCenterController::class, 'insertRetailCenter']);

// Insert retail center item
Route::post('/retail-center/insert', [retailCenterController::class, 'submitRetailCenter']);

// Retail center delete request
Route::get('/retail-center/delete/{uniqueID}', [retailCenterController::class, 'deleteRetailCenter']);

// Request to redirect to retail center update page
Route::get('/retail-center/update/{uniqueID}', [retailCenterController::class, 'viewRetailCenter']);

// Form submission updated retail center
Route::post('/retail-center/update/{uniqueID}/submit', [retailCenterController::class, 'updateRetailCenter']);

// Transportation event display page
Route::get('/transportation-event', [transportationEventController::class, 'displayTransportationEvent']);

// Display transportation event form page
Route::get('/transportation-event/insert', [transportationEventController::class, 'insertTransportationEvent']);

// Insert transportation event item
Route::post('/transportation-event/insert', [transportationEventController::class, 'submitTransportationEvent']);

// Delete request for transportation event
Route::get('/transportation-event/delete/{scheduleNumber}', [transportationEventController::class, 'deleteTransportationEvent']);

// Redirect to form to edit transport event
Route::get('/transportation-event/update/{scheduleNumber}', [transportationEventController::class, 'viewTransportationEvent']);

// Form submission for updated transportation event
Route::post('/transportation-event/update/{scheduleNumber}/submit', [transportationEventController::class, 'updateTransportationEvent']);

// Route to processes page
Route::get('/processes', [processesController::class, 'displayProcesses']);

// sumbit shipped items retail center form
Route::post('/processes/receivedAt', [processesController::class, 'receivedAtProcesses']);

// submit shipped items transportationn method form
Route::post('/processes/transportationMethod', [processesController::class, 'transportationMethodProcesses']);

// To remove Retail center ID from shipped items
Route::get('/home/delete/uniqueID/{uniqueID}/itemNumber/{itemNumber}', [homeController::class, 'deleteUniqueID']);

// To remove transportation event ID from shipped items
Route::get('/home/delete/scheduleNumber/{scheduleNumber}/itemNumber/{itemNumber}', [homeController::class, 'deleteScheduleNumber']);

Route::get('/login', [loginController::class, 'loginPage'])-> middleware('guest');

Route::post('/login', [loginController::class, 'login'])->name('login');

Route::post('/logout', [loginController::class, 'logout']);

Route::get('/sign-up', [loginController::class, 'signUpPage']);

Route::post('/sign-up', [loginController::class, 'createAccount']);