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

    Route::get('/pages', [PageController::class, 'index'])->name('pages');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{pages}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{pages}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('pages/{pages}/delete', [PageController::class, 'destroy'])->name('pages.destroy');

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
});

require __DIR__ . '/auth.php';
