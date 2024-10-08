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
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ReferencingStyleController;
use App\Http\Controllers\TutorViewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddExpertController;
use App\Http\Controllers\ViewExpertController;
use App\Http\Controllers\ExpertsController;
use App\Http\Controllers\ExpertReviewsController;
use App\Http\Controllers\StudentMarketController;
use App\Http\Controllers\AffiliateUserController;

use App\Http\Controllers\ImageUploadController as ImageUploadController;

use App\Http\Controllers\DealCategoriesController;
use App\Http\Controllers\BlogCategoriesController;
use App\Http\Controllers\DealsController;
use App\Http\Controllers\ServiceKeywordsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WithdrawRequestController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StaffUserController;





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
     if(Auth::user()){
          return redirect()->route('dashboard');
     }else{
          return view('auth.login');
     }
    
});
/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::post('/upload-image',  [ImageUploadController::class,'upload'])->name('upload.image')->withoutMiddleware(['auth'])->withoutMiddleware(['web']);

//Route::get('/pages/{seo_url_slug}', [PageController::class, 'showPage'])->name('show-page');
Route::middleware(['auth','is_authorized'])->group(function () {


     Route::get('permission/{id?}', [PermissionController::class,'index'])->name('permission.index');
     Route::post('permission/update', [PermissionController::class,'update'])->name('permission.update');

     Route::get('permission/users/{id?}', [PermissionController::class,'userPermission'])->name('permission.userPermission');
     Route::post('permission/users/update', [PermissionController::class,'updateUserPermission'])->name('permission.updateUserPermission');




//     Route::post('/upload-image', [ImageUploadController::class,'upload'])->name('upload.image');


     Route::get('/withdraw-requests', [WithdrawRequestController::class,'index'])->name('withdraw_request_view');
     Route::get('/withdraw-requests/details/{requestId}', [WithdrawRequestController::class,'withdrawDetails'])->name('withdraw_request_details');
     Route::post('/withdraw-requests/accept/{requestId}', [WithdrawRequestController::class,'acceptRequest'])->name('accept_withdraw_requests');
     Route::post('/withdraw-requests/decline/{requestId}', [WithdrawRequestController::class,'declineRequest'])->name('decline_withdraw_requests');


     Route::get('/tutor-withdraw-requests', [WithdrawRequestController::class,'tutorWithdrawRequests'])->name('tutor_withdraw_request_view');
     Route::get('/tutor-withdraw-requests/details/{requestId}', [WithdrawRequestController::class,'tutorWithdrawDetails'])->name('tutor_withdraw_request_details');
     Route::post('/tutor-withdraw-requests/accept/{requestId}', [WithdrawRequestController::class,'tutorAcceptRequest'])->name('tutor_accept_withdraw_requests');
     Route::post('/tutor-withdraw-requests/decline/{requestId}', [WithdrawRequestController::class,'tutorDeclineRequest'])->name('tutor_decline_withdraw_requests');


    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
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
    Route::get('/pages', [ServiceController::class, 'page'])->name('pages');
    // Route::get('/pages/create/{id?}', [ServiceController::class, 'create'])->name('pages.create');
    Route::get('/pages/edit/{id}', [ServiceController::class, 'create'])->name('pages.edit');





    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categories}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categories}', [CategoriesController::class, 'update'])->name('categories.update');



    //Route::get('/orders/{student_id?}', [OrdersController::class, 'index'])->name('orders');

    Route::get('/orders/payment/{student_id?}', [OrdersController::class, 'paymentDone'])->name('orders.payment_done');
    Route::get('/orders/payment-failed/{student_id?}', [OrdersController::class, 'enquery'])->name('orders.enquery');
    Route::get('/orders/new/{student_id?}', [OrdersController::class, 'newOrders'])->name('orders.new');
    Route::get('/orders/ongoing/{student_id?}', [OrdersController::class, 'onGoingOrders'])->name('orders.ongoing');
    Route::get('/orders/completed/{student_id?}', [OrdersController::class, 'completedOrders'])->name('orders.completed');





   
    
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
	
	Route::get('/get-task-types', [AjaxController::class, 'getTaskTypes'])->name('get_task_types');

    Route::post('/order/message', [OrdersController::class, 'sendMessage'])->name('send_message');
    Route::post('/request/message', [OrdersController::class, 'sendRequestMessage'])->name('send_request_message');
    Route::post('/request/submit/budget/{id}', [OrdersController::class, 'submitFinalBudget'])->name('submit_budget');


    Route::get('/order/tutor-request-sent/{id}', [OrdersController::class, 'tutorRequestSent'])->name('tutor_request_sent');
    Route::get('/order/qc-request-sent/{id}', [OrdersController::class, 'qcRequestSent'])->name('qc_request_sent');

    Route::post('/order/deliver/{id}', [OrdersController::class, 'deliverToStudent'])->name('deliver_to_student');

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
    Route::post('/enquery/export/{type}', [PageController::class, 'EnqueryExport'])->name('enquery.export');

    Route::get('/contact/form-store/{type}', [PageController::class, 'dataStore'])->name('contact.form.store');
    Route::post('/contact/customer-attendant/{id}', [PageController::class, 'customerAttendant'])->name('contact.customer.attendant');

    Route::post('/contact/form', [PageController::class, 'dataStore1'])->name('form.store');
    Route::get('/media', [MediaController::class, 'index'])->name('media.save');
    Route::post('/save', [MediaController::class, 'save'])->name('media.store');
    Route::get('/media-data', [MediaController::class, 'getData'])->name('media.data');
    Route::post('/media/delete', [MediaController::class, 'deleteMedia'])->name('deleteMedia');
    Route::get('/subscription/list', [MediaController::class, 'subscription'])->name('subscription');
    Route::post('/subscription/delete', [MediaController::class, 'subscriptionDelete'])->name('subscriptionDelete');
    Route::post('/subscription/export', [MediaController::class, 'subscriptionExport'])->name('subscription.export');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');


    Route::group([
        'prefix' => 'coupons',
    ], function () {
        Route::get('/', [CouponsController::class, 'index'])
             ->name('coupons.coupon.index');
        Route::get('/create', [CouponsController::class, 'create'])
             ->name('coupons.coupon.create');
        Route::get('/show/{coupon}',[CouponsController::class, 'show'])
             ->name('coupons.coupon.show')->where('id', '[0-9]+');
        Route::get('/{coupon}/edit',[CouponsController::class, 'edit'])
             ->name('coupons.coupon.edit')->where('id', '[0-9]+');
        Route::post('/', [CouponsController::class, 'store'])
             ->name('coupons.coupon.store');
        Route::any('coupon/{coupon}', [CouponsController::class, 'update'])
             ->name('coupons.coupon.update')->where('id', '[0-9]+');
        Route::any('/coupon/{coupon}/destroy',[CouponsController::class, 'destroy'])
             ->name('coupons.coupon.destroy')->where('id', '[0-9]+');
            });

            Route::group([
               'prefix' => 'students',
           ], function () {

               Route::post('/students/export', [StudentsController::class, 'StudentsExport'])->name('students.export');

               Route::get('/', [StudentsController::class, 'index'])
                    ->name('students.student.index');
               Route::get('/create', [StudentsController::class, 'create'])
                    ->name('students.student.create');
               Route::get('/show/{student}',[StudentsController::class, 'show'])
                    ->name('students.student.show')->where('id', '[0-9]+');
               Route::get('/{student}/edit',[StudentsController::class, 'edit'])
                    ->name('students.student.edit')->where('id', '[0-9]+');
               Route::post('/', [StudentsController::class, 'store'])
                    ->name('students.student.store');
               Route::any('student/{student}', [StudentsController::class, 'update'])
                    ->name('students.student.update')->where('id', '[0-9]+');

               Route::delete('/student/{student}',[StudentsController::class, 'destroy'])
                    ->name('students.student.destroy')->where('id', '[0-9]+');
                   });

                   Route::patch('student/status/{student}', [StudentsController::class, 'change'])
                    ->name('students.student.change')->where('id', '[0-9]+');




                    Route::post('/addexpert', [AddExpertController::class, 'index'])->name('addexpert');
                    Route::get('/viewexpert', [ViewExpertController::class, 'index'])->name('viewexpert');
                    
                    Route::group([
                         'prefix' => 'experts',
                     ], function () {
                         Route::get('/', [ExpertsController::class, 'index'])
                              ->name('experts.expert.index');
                         Route::get('/create', [ExpertsController::class, 'create'])
                              ->name('experts.expert.create');
                         Route::get('/show/{expert}',[ExpertsController::class, 'show'])
                              ->name('experts.expert.show')->where('id', '[0-9]+');
                         Route::get('/{expert}/edit',[ExpertsController::class, 'edit'])
                              ->name('experts.expert.edit')->where('id', '[0-9]+');
                         Route::post('/', [ExpertsController::class, 'store'])
                              ->name('experts.expert.store');
                         Route::put('expert/{expert}', [ExpertsController::class, 'update'])
                              ->name('experts.expert.update')->where('id', '[0-9]+');
                         Route::delete('/expert/{expert}',[ExpertsController::class, 'destroy'])
                              ->name('experts.expert.destroy')->where('id', '[0-9]+');
                         Route::get('/addreview', [ExpertsController::class, 'addreview'])
                              ->name('experts.expert.addreview');

                              Route::patch('experts/status/{expert}', [ExpertsController::class, 'change'])
                    ->name('experts.expert.change')->where('id', '[0-9]+');
                     });



                     Route::group([
                         'prefix' => 'staffuser',
                     ], function () {
                         Route::get('/add', [StaffUserController::class, 'index'])->name('staffuser.add');
                         Route::post('/store', [StaffUserController::class, 'store'])->name('staffuser.store');
                         Route::get('/{id}/edit', [StaffUserController::class, 'edit'])->name('staffuser.edit');
                         Route::put('/{id}/update', [StaffUserController::class, 'update'])->name('staffuser.update');
                         Route::delete('/delete/{id}',[StaffUserController::class, 'destroy'])->name('staffuser.destroy')->where('id', '[0-9]+');
                         Route::patch('change/status/{id}', [StaffUserController::class, 'change'])->name('staffuser.change')->where('id', '[0-9]+');
                         Route::get('/', [StaffUserController::class, 'view'])->name('staffuser.list');     
                     });

                     

                     Route::group([
                         'prefix' => 'affiliateuser',
                     ], function () {
                         Route::get('/addaffiliate', [AffiliateUserController::class, 'index'])
                              ->name('affiliateuser.affiliate.add');


                              Route::get('/storeaffiliate', [AffiliateUserController::class, 'store'])
                              ->name('affiliateuser.affiliate.store');



                              Route::get('/{id}/editaffiliate', [AffiliateUserController::class, 'edit'])
                              ->name('affiliateuser.affiliate.edit');

                              Route::post('/{id}/updateaffiliate', [AffiliateUserController::class, 'update'])
                              ->name('affiliateuser.affiliate.update');



                              Route::delete('/affilate/{affilate}',[AffiliateUserController::class, 'destroy'])
                    ->name('affilate.destroy')->where('id', '[0-9]+');
                   

                   Route::patch('affilate/status/{affilate}', [AffiliateUserController::class, 'change'])
                    ->name('affilate.change')->where('id', '[0-9]+');
                    

                              Route::get('/viewaffiliate', [AffiliateUserController::class, 'view'])
                              ->name('affiliateuser.affiliate.view');     
                        
                     });


                     Route::group([
                         'prefix' => 'studentmarket',
                     ], function () {

                         Route::get('/dealscategory', [StudentMarketController::class, 'deals_category'])->name('studentmarket.student.deals_category');
                         Route::post('/', [StudentMarketController::class, 'store'])->name('deal_categories.deal_category.store');
                         Route::get('/{dealCategory}/edit',[StudentMarketController::class, 'edit'])->name('deal_categories.deal_category.edit')->where('id', '[0-9]+');

                         Route::post('deal_category/update/{dealCategory}', [StudentMarketController::class, 'update'])->name('deal_categories.deal_category.update')->where('id', '[0-9]+');

                         Route::any('/deal_category/{dealCategory}',[StudentMarketController::class, 'destroyCategory'])->name('deal_categories.deal_category.destroy')->where('id', '[0-9]+');

                       
                         Route::get('/adddeals', [StudentMarketController::class, 'add_deals'])
                              ->name('studentmarket.student.add_deals');


                              Route::post('/storeDeals', [StudentMarketController::class, 'storeDeals'])
         ->name('deals.deal.store');

                         Route::get('/viewdeals', [StudentMarketController::class, 'view_deals'])
                              ->name('studentmarket.student.view_deals');     
                     });

                     
                     
                     Route::any('/deal/{deal}/destroy',[StudentMarketController::class, 'destroy'])
         ->name('deals.deal.destroy')->where('id', '[0-9]+');

         Route::get('/{deal}/edit',[StudentMarketController::class, 'edit_deals'])
         ->name('deals.deal.edit')->where('id', '[0-9]+');

         Route::post('deal/{deal}', [StudentMarketController::class, 'update_deals'])
         ->name('deals.deal.update')->where('id', '[0-9]+');

         //Route::delete('/deal/{deal}',[StudentMarketController::class, 'destroy'])
         //->name('deals.deal.destroy')->where('id', '[0-9]+');
         


     Route::get('/notificationslist/{type}', [App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
                         
});

require __DIR__ . '/auth.php';
Route::group([
    'prefix' => 'expert_reviews',
], function () {
    Route::get('/expert-reviews/{id}', [ExpertReviewsController::class, 'index'])
         ->name('expert_reviews.expert_review.index');

    Route::get('/create', [ExpertReviewsController::class, 'create'])
         ->name('expert_reviews.expert_review.create');
    Route::get('/show/{expertReview}',[ExpertReviewsController::class, 'show'])
         ->name('expert_reviews.expert_review.show')->where('id', '[0-9]+');
    Route::get('/{expertReview}/edit',[ExpertReviewsController::class, 'edit'])
         ->name('expert_reviews.expert_review.edit')->where('id', '[0-9]+');

    Route::post('/{id}', [ExpertReviewsController::class, 'store'])
         ->name('expert_reviews.expert_review.store');

    Route::put('expert_review/{expertReview}', [ExpertReviewsController::class, 'update'])
         ->name('expert_reviews.expert_review.update')->where('id', '[0-9]+');
    Route::delete('/expert_review/{expertReview}',[ExpertReviewsController::class, 'destroy'])
         ->name('expert_reviews.expert_review.destroy')->where('id', '[0-9]+');

         Route::patch('expert_review/expert_review/{review}', [ExpertReviewsController::class, 'change'])
                    ->name('experts.review.change')->where('id', '[0-9]+');
                    

         
});

Route::post('/image-upload', [AjaxController::class, 'imageUpload'])->name('imageupload');
Route::group([
    'prefix' => 'service_keywords',
], function () {
    Route::get('/', [ServiceKeywordsController::class, 'index'])
         ->name('service_keywords.service_keyword.index');
    Route::get('/create', [ServiceKeywordsController::class, 'create'])
         ->name('service_keywords.service_keyword.create');
    Route::get('/show/{serviceKeyword}',[ServiceKeywordsController::class, 'show'])
         ->name('service_keywords.service_keyword.show')->where('id', '[0-9]+');
    Route::get('/{serviceKeyword}/edit',[ServiceKeywordsController::class, 'edit'])
         ->name('service_keywords.service_keyword.edit')->where('id', '[0-9]+');
    Route::post('/', [ServiceKeywordsController::class, 'store'])
         ->name('service_keywords.service_keyword.store');
    Route::put('service_keyword/{serviceKeyword}', [ServiceKeywordsController::class, 'update'])
         ->name('service_keywords.service_keyword.update')->where('id', '[0-9]+');
    Route::delete('/service_keyword/{serviceKeyword}',[ServiceKeywordsController::class, 'destroy'])
         ->name('service_keywords.service_keyword.destroy')->where('id', '[0-9]+');

         Route::patch('/service_keyword/{serviceKeyword}',[ServiceKeywordsController::class, 'change'])
         ->name('service_keywords.service_keyword.change')->where('id', '[0-9]+');
});


Route::group([
     'prefix' => 'blog_categories',
 ], function () {
     Route::get('/', [BlogCategoriesController::class, 'index'])
          ->name('blog_categories.blog_category.index');

     Route::get('/create', [BlogCategoriesController::class, 'create'])
          ->name('blog_categories.blog_category.create');

     Route::get('/show/{blogCategory}',[BlogCategoriesController::class, 'show'])
          ->name('blog_categories.blog_category.show')->where('id', '[0-9]+');

     Route::get('/{blogCategory}/edit',[BlogCategoriesController::class, 'edit'])
          ->name('blog_categories.blog_category.edit')->where('id', '[0-9]+');

     Route::post('/', [BlogCategoriesController::class, 'store'])
          ->name('blog_categories.blog_category.store');

     Route::put('blog_category/{blogCategory}', [BlogCategoriesController::class, 'update'])
          ->name('blog_categories.blog_category.update')->where('id', '[0-9]+');

     Route::delete('/blog_category/{blogCategory}',[BlogCategoriesController::class, 'destroy'])
          ->name('blog_categories.blog_category.destroy')->where('id', '[0-9]+');
 
          Route::patch('/blog_category/{blogCategory}',[BlogCategoriesController::class, 'change'])
          ->name('blog_categories.blog_category.change')->where('id', '[0-9]+');
 });