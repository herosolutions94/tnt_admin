<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Ajax;
use App\Http\Controllers\Account;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentPages;
use App\Http\Controllers\Controller;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
/*==============================API POST Routes =====================================*/



Route::post('/get_data', [App\Http\Controllers\Ajax::class, 'get_data']);
Route::post('/save-newsletter', [App\Http\Controllers\Ajax::class, 'newsletter']);
Route::post('/save-contact-message', [App\Http\Controllers\Ajax::class, 'contact_us']);
Route::post('/save-request-quote', [App\Http\Controllers\Ajax::class, 'request_quote']);
Route::post('/save-image', [App\Http\Controllers\Ajax::class, 'save_image']);
Route::post('/save-verification-uploads', [App\Http\Controllers\Ajax::class, 'save_verification_uploads']);
Route::post('/upload-image', [App\Http\Controllers\Ajax::class, 'upload_image']);
Route::post('/upload-file', [App\Http\Controllers\Ajax::class, 'upload_file']);
Route::get('/get-states/{country_id}', [App\Http\Controllers\Ajax::class, 'get_states']);

Route::post('/apply', [App\Http\Controllers\Ajax::class, 'apply']);


/*==============================API GET Routes =====================================*/
Route::match(['GET', 'POST'], '/site-settings', [ContentPages::class, 'website_settings']);
// Route::match(['GET','POST'], '/member-settings', [ContentPages::class,'member_settings']);
Route::match(['GET', 'POST'], '/home-page', [ContentPages::class, 'home_page']);
Route::match(['GET', 'POST'], '/become_creator', [ContentPages::class, 'become_creator']);
Route::match(['GET', 'POST'], '/request_quote', [ContentPages::class, 'request_quote']);






/*==============================BLOG API Routes =====================================*/
// Route::match(['GET', 'POST'], '/blog-page', [ContentPages::class, 'blog_page']);
// Route::match(['GET', 'POST'], '/blog-details-page/{slug}', [ContentPages::class, 'blog_details_page']);
// Route::match(['GET', 'POST'], '/get-reviews/{mem_id}', [ContentPages::class, 'get_reviews']);