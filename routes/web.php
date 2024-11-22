<?php

use Illuminate\Support\Facades\Route;

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

//-------------------------------- Register -------------------------------------------------------- 

Route::group(['prefix' => '/register', 'namespace' => 'Register'], function () {

    Route::get('/', [App\Http\Controllers\Admin\Register\RegisterController::class, 'getShow'])
        ->name('Auth-RegisterGetShow');

    Route::post('/store', [App\Http\Controllers\Admin\Register\RegisterController::class, 'postStore'])
        ->name('Auth-RegisterPostStore');    
});


//--------------------------------- Login ----------------------------------------------------------


Route::group(['prefix' => '/', 'namespace' => 'Login'], function () {

    Route::get('/', [App\Http\Controllers\Admin\Login\LoginController::class, 'getShow'])
        ->name('Auth-LoginGetShow');

    Route::post('/store', [App\Http\Controllers\Admin\Login\LoginController::class, 'postStore'])
        ->name('Auth-LoginPostStore');    
});





Route::group(['prefix' => '/', 'namespace' => 'Admin', 'middleware' => "auth"], function () {


//--------------------------------- Logout -------------------------------------------------------------

Route::post('/', [App\Http\Controllers\Admin\Login\LoginController::class, 'postLogout'])
->name('postLogout');    




//---------------------------------- Dashboard -----------------------------------------------------   

    Route::group(['prefix' => '/dashboard', 'namespace' => 'Dashboard'], function () {

        Route::get('/', [App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'getShow'])
            ->name('Admin-DashboardGetShow');     
    });  




//-------------------------------- Profile -------------------------------------------------------- 

    Route::group(['prefix' => '/profile', 'namespace' => 'Profile'], function () {

        Route::get('/', [App\Http\Controllers\Admin\Profile\ProfileController::class, 'getShow'])
            ->name('Admin-ProfileGetShow');

        Route::get('/edit/{user}', [App\Http\Controllers\Admin\Profile\ProfileController::class, 'getEdit'])
            ->name('Admin-ProfileGetEdit'); 
            
        Route::post('/edit/{user}', [App\Http\Controllers\Admin\Profile\ProfileController::class, 'postUpdate'])
            ->name('Admin-ProfilePostUpdate');     
    });
    
    


//-------------------------------- Contribution -------------------------------------------------------- 

    Route::group(['prefix' => '/contribution', 'namespace' => 'contribution'], function () {

        Route::get('/', [App\Http\Controllers\Admin\Contribution\ContributionController::class, 'getShow'])
            ->name('Admin-ContributionGetShow');

        Route::get('/create', [App\Http\Controllers\Admin\Contribution\ContributionController::class, 'getCreate'])
            ->name('Admin-ContributionGetCreate');    
            
        Route::post('/store', [App\Http\Controllers\Admin\Contribution\ContributionController::class, 'postStore'])
            ->name('Admin-ContributionPostStore');

        Route::get('/edit/{contribution}', [App\Http\Controllers\Admin\Contribution\ContributionController::class, 'getEdit'])
            ->name('Admin-ContributionGetEdit'); 
            
        Route::post('/edit/{contribution}', [App\Http\Controllers\Admin\Contribution\ContributionController::class, 'postUpdate'])
            ->name('Admin-ContributionPostUpdate');  
            
        Route::delete('/contribution/{id}', [App\Http\Controllers\Admin\Contribution\ContributionController::class, 'postDestroy'])
            ->name('Admin-ContributionPostDestroy');      
    });



//-------------------------------- Member -------------------------------------------------------- 

    Route::group(['prefix' => '/member', 'namespace' => 'Member'], function () {

        Route::get('/', [App\Http\Controllers\Admin\Member\MemberController::class, 'getShow'])
            ->name('Admin-MemberGetShow');

        Route::get('/create', [App\Http\Controllers\Admin\Member\MemberController::class, 'getCreate'])
            ->name('Admin-MemberGetCreate');
            
        Route::post('/store', [App\Http\Controllers\Admin\Member\MemberController::class, 'postStore'])
            ->name('Admin-MemberPostStore');

        Route::get('/edit/{member}', [App\Http\Controllers\Admin\Member\MemberController::class, 'getEdit'])
            ->name('Admin-MemberGetEdit'); 
            
        Route::post('/edit/{member}', [App\Http\Controllers\Admin\Member\MemberController::class, 'postUpdate'])
            ->name('Admin-MemberPostUpdate');
            
        Route::delete('/member/{id}', [App\Http\Controllers\Admin\Member\MemberController::class, 'postDestroy'])
            ->name('Admin-MemberPostDestroy');    
    });        


//---------------------------------- Reception -----------------------------------------------------   

        Route::group(['prefix' => '/reception', 'namespace' => 'Reception'], function () {

            Route::get('/', [App\Http\Controllers\Admin\Reception\ReceptionController::class, 'getShow'])
                ->name('Admin-ReceptionGetShow');   
        }); 


//---------------------------------- Notification -----------------------------------------------------   

        Route::group(['prefix' => '/notification', 'namespace' => 'notification'], function () {

            Route::get('/', [App\Http\Controllers\Admin\Notification\NotificationController::class, 'getShow'])
                ->name('Admin-NotificationGetShow');

            Route::post('/', [App\Http\Controllers\Admin\Notification\NotificationController::class, 'sendNotification'])
                ->name('Admin-sendNotification')->middleware('auth');     
        });


//---------------------------------- Payement -----------------------------------------------------   

        Route::group(['prefix' => '/payement', 'namespace' => 'Payement'], function () {

            Route::get('/', [App\Http\Controllers\Admin\Payement\PayementController::class, 'getShow'])
                ->name('Admin-PayementGetShow');  
                
            Route::get('/create/{id}', [App\Http\Controllers\Admin\Payement\PayementController::class, 'getCreate'])
                ->name('Admin-PayementGetCreate'); 
                
            Route::post('/store', [App\Http\Controllers\Admin\Payement\PayementController::class, 'postStore'])
                ->name('Admin-PayementPostStore'); 
                
            Route::delete('/{id}', [App\Http\Controllers\Admin\Payement\PayementController::class, 'postDestroy'])
                ->name('Admin-PayementPostDestroy');     
        });



//---------------------------------- Versement -----------------------------------------------------   

        Route::group(['prefix' => '/versement', 'namespace' => 'Versement'], function () {

            Route::get('/', [App\Http\Controllers\Admin\Versement\VersementController::class, 'getShow'])
                ->name('Admin-VersementGetShow'); 
                
            Route::get('/create/{id}', [App\Http\Controllers\Admin\Versement\VersementController::class, 'getCreate'])
                ->name('Admin-VersementGetCreate');   
                
            Route::post('/store', [App\Http\Controllers\Admin\Versement\VersementController::class, 'postStore'])
                ->name('Admin-VersementPostStore');

            Route::get('/edit/{versement}', [App\Http\Controllers\Admin\Versement\VersementController::class, 'getEdit'])
                ->name('Admin-VersementGetEdit');     
                
            Route::post('/edit/{versement}', [App\Http\Controllers\Admin\Versement\VersementController::class, 'postUpdate'])
                ->name('Admin-VersementPostUpdate');  
                
            Route::delete('/{id}', [App\Http\Controllers\Admin\Versement\VersementController::class, 'postDestroy'])
                ->name('Admin-VersementPostDestroy'); 
                
            Route::post('/{id}/complete', [App\Http\Controllers\Admin\Versement\VersementController::class, 'postComplete'])
                ->name('Admin-VersementPostComplete');     
                   
        });


//---------------------------------- Subscription -----------------------------------------------------   

        Route::group(['prefix' => '/subscription', 'namespace' => 'Subscription'], function () {

            Route::get('/', [App\Http\Controllers\Admin\Subscription\SubscriptionController::class, 'getShow'])
                ->name('Admin-SubscriptionGetShow');   
        });         


});
