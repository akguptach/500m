<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskTypeController;
use App\Http\Controllers\StudyLabelsController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LevelStudyController as level;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReferencingStyleController;
use App\Http\Controllers\TutorViewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::match(['get', 'head'], '/', function () {
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/pages/{seo_url_slug}', [PageController::class, 'showPage'])->name('show-page');
Route::middleware('auth')->group(function () {
    Route::resource('/role', RoleController::class);
    Route::resource('/subject', SubjectController::class);
    Route::resource('/tasktype', TaskTypeController::class);
    Route::resource('/studylabel', StudyLabelsController::class);
    Route::resource('/website', WebsiteController::class);
    Route::resource('/tutor', TutorController::class);
    Route::resource('/faq', FaqController::class);
    Route::resource('/level_study', level::class);
    Route::resource('/grade', GradesController::class);
    Route::resource('/blog', BlogController::class);
    Route::resource('/referencing', ReferencingStyleController::class);

    /*Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{pages}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{pages}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{pages}/delete', [PageController::class, 'destroy'])->name('pages.destroy');
    Route::post('/pages/store-faq', [PageController::class, 'storeFaq'])->name('pages.store.faq');
    Route::post('/pages/store-ratings', [PageController::class, 'storeRatings'])->name('pages.store.ratings');*/

    //////

    Route::get('/pages/create/{id?}', function () {
        return \App::call('App\Http\Controllers\ServiceController@create', ['type' => 'PAGE']);
    })->name('pages.create');


    /*Route::get('/services/store-basic', function () {
        return \App::call('App\Http\Controllers\ServiceController@storeBasic', ['type' => 'PAGE']);
    })->name('services.store.basic');*/



    Route::get('/pages', [ServiceController::class, 'page'])->name('pages');
    // Route::get('/pages/create/{id?}', [ServiceController::class, 'create'])->name('pages.create');
    Route::get('/pages/edit/{id}', [ServiceController::class, 'create'])->name('pages.edit');
    Route::post('/services/store-basic', [ServiceController::class, 'storeBasic'])->name('services.store.basic');
    Route::post('/services/store-seo', [ServiceController::class, 'storeSeo'])->name('services.store.seo');
    Route::post('/services/store-faq', [ServiceController::class, 'storeFaq'])->name('services.store.faq');
    Route::post('/services/store-specification', [ServiceController::class, 'storeSpecification'])->name('services.store.specification');
    Route::post('/services/store-how-works', [ServiceController::class, 'storeHowWorks'])->name('services.store.how_works');
    Route::post('/services/store-assist-btn', [ServiceController::class, 'storeAssistBtn'])->name('services.store.assist_btn');
    Route::post('/services/store-ratings', [ServiceController::class, 'storeRatings'])->name('services.store.ratings');
    Route::post('/services/why-educrafter', [ServiceController::class, 'storeWhyEducrafter'])->name('services.store.why_educrafter');
    Route::delete('services/{id}/delete', [ServiceController::class, 'destroy'])->name('services.destroy');
    //////



    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categories}', [CategoriesController::class, 'update'])->name('categories.update');

    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/orders/{orders}/view', [OrdersController::class, 'view'])->name('orders.view');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/address/{tutor}', [TutorViewController::class, 'address'])->name('address');
    Route::get('/bank/{tutor}', [TutorViewController::class, 'bank'])->name('bank');
    Route::get('/kyc/{tutor}', [TutorViewController::class, 'kyc'])->name('kyc');
    Route::get('/education/{tutor}', [TutorViewController::class, 'education'])->name('education');
    Route::get('/tutor_view/{profile_status}', [TutorViewController::class, 'profile_status'])->name('tutor_view.profile_status');



    Route::get('/get-teacher-list/{order_id}/{student_id}/{type}', [AjaxController::class, 'getTeacherList'])->name('get_teachers');

    Route::post('/tutor-assign-request', [AjaxController::class, 'tutorAssignRequest'])->name('tutor_assign_request');
    Route::post('/qc-assign-request', [AjaxController::class, 'qcAssignRequest'])->name('qc_assign_request');

    Route::post('/order/message', [OrdersController::class, 'sendMessage'])->name('send_message');
    Route::post('/request/message', [OrdersController::class, 'sendRequestMessage'])->name('send_request_message');
    Route::post('/request/submit/budget/{id}', [OrdersController::class, 'submitFinalBudget'])->name('submit_budget');


    Route::get('/order/tutor-request-sent/{id}', [OrdersController::class, 'tutorRequestSent'])->name('tutor_request_sent');
    Route::get('/order/qc-request-sent/{id}', [OrdersController::class, 'qcRequestSent'])->name('qc_request_sent');


    Route::get('/services', [ServiceController::class, 'index'])->name('services_index');

    Route::get('/services/create/{id?}', [ServiceController::class, 'create'])->name('services.create');
    Route::get('/services/edit/{id}', [ServiceController::class, 'create'])->name('services.edit');

    Route::post('/services/store-basic', [ServiceController::class, 'storeBasic'])->name('services.store.basic');
    Route::post('/services/store-seo', [ServiceController::class, 'storeSeo'])->name('services.store.seo');
    Route::post('/services/store-faq', [ServiceController::class, 'storeFaq'])->name('services.store.faq');
    Route::post('/services/store-specification', [ServiceController::class, 'storeSpecification'])->name('services.store.specification');


    Route::post('/services/store-how-works', [ServiceController::class, 'storeHowWorks'])->name('services.store.how_works');

    Route::post('/services/store-assist-btn', [ServiceController::class, 'storeAssistBtn'])->name('services.store.assist_btn');


    Route::post('/services/store-ratings', [ServiceController::class, 'storeRatings'])->name('services.store.ratings');

    Route::post('/services/why-educrafter', [ServiceController::class, 'storeWhyEducrafter'])->name('services.store.why_educrafter');

    Route::delete('services/{id}/delete', [ServiceController::class, 'destroy'])->name('services.destroy');
    //Route::post('/services/store', [ServiceController::class, 'store'])->name('pages.store');
    //Route::get('/services/{pages}/edit', [ServiceController::class, 'edit'])->name('pages.edit');
    //Route::put('/services/{pages}', [ServiceController::class, 'update'])->name('pages.update');
    //Route::delete('services/{pages}/delete', [ServiceController::class, 'destroy'])->name('pages.destroy');


});

require __DIR__ . '/auth.php';