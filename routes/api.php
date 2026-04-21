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
Route::match(['GET', 'POST'], '/aviva-pools-page', [ContentPages::class, 'aviva_pools_page']);
Route::match(['GET', 'POST'], '/aviva-detail-page', [ContentPages::class, 'aviva_details_page']);
Route::match(['GET', 'POST'], '/contact-us-page', [ContentPages::class, 'contact_us_page']);
Route::match(['GET', 'POST'], '/job-details-page/{slug}', [ContentPages::class, 'job_details_page']);
Route::match(['GET', 'POST'], '/apply-job-page', [ContentPages::class, 'apply_job_page']);
Route::match(['GET', 'POST'], '/resources-page', [ContentPages::class, 'resources_page']);
Route::match(['GET', 'POST'], '/resource-details-page/{slug}', [ContentPages::class, 'resource_details_page']);
Route::match(['GET', 'POST'], '/areas-experties-page', [ContentPages::class, 'areas_experties_page']);
Route::match(['GET', 'POST'], '/hardscapes-page', [ContentPages::class, 'hardscapes_page']);
Route::match(['GET', 'POST'], '/services-template-page', [ContentPages::class, 'services_template_page']);
Route::match(['GET', 'POST'], '/executive-search-page', [ContentPages::class, 'executive_search_page']);
Route::match(['GET', 'POST'], '/how-we-work-page', [ContentPages::class, 'colors_page']);
Route::match(['GET', 'POST'], '/about-us-page', [ContentPages::class, 'about_us_page']);
Route::match(['GET', 'POST'], '/blog-page', [ContentPages::class, 'blog_page']);
Route::match(['GET', 'POST'], '/executive-group-page', [ContentPages::class, 'executive_group_page']);
Route::match(['GET', 'POST'], '/renaissance-patio-page', [ContentPages::class, 'renaissance_patio_page']);
Route::match(['GET', 'POST'], '/story-and-concept-page', [ContentPages::class, 'story_and_concept_page']);
Route::match(['GET', 'POST'], '/why-work-with-elios-page', [ContentPages::class, 'why_work_with_elios_page']);
Route::match(['GET', 'POST'], '/why-work-with-elios-page', [ContentPages::class, 'why_work_with_elios_page']);
Route::match(['GET', 'POST'], '/contact-page', [ContentPages::class, 'contact_page']);
Route::match(['GET', 'POST'], '/stick-built-page', [ContentPages::class, 'stick_built_page']);
Route::match(['GET', 'POST'], '/terms-conditions-page', [ContentPages::class, 'terms_conditions_page']);

/*==============================Services API Routes =====================================*/
Route::match(['GET', 'POST'], '/service-details-page/{slug}', [ContentPages::class, 'service_details_page']);

Route::match(['GET', 'POST'], '/area-of-expertise-details-page/{slug}', [ContentPages::class, 'aox_details_page']);




/*==============================BLOG API Routes =====================================*/
// Route::match(['GET', 'POST'], '/blog-page', [ContentPages::class, 'blog_page']);
// Route::match(['GET', 'POST'], '/blog-details-page/{slug}', [ContentPages::class, 'blog_details_page']);
// Route::match(['GET', 'POST'], '/get-reviews/{mem_id}', [ContentPages::class, 'get_reviews']);