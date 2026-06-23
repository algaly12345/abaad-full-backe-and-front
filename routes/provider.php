<?php

use App\Enums\ViewPaths\Vendor\Profile;
use App\Http\Controllers\Dashboard\serviceProvider\auth\LoginController;
use App\Http\Controllers\Dashboard\serviceProvider\EstaeController;
use App\Http\Controllers\Dashboard\serviceProvider\OfferController;
use App\Http\Controllers\Dashboard\serviceProvider\ProfileController;
use App\Http\Controllers\Dashboard\serviceProvider\DashboardController;

use Illuminate\Support\Facades\Route;

// Route::get('/auth/service-provider', [LoginController::class,'loginForm'])->name('auth.service-provider.loginForm');
// Route::post('/auth/service-provider', [LoginController::class,'login'])->name('auth.service-provider.login');

Route::get('update/{id}', [OfferController::class,'update'])->name('provider.profile.update');
Route::put('/providers/profile/update', [OfferController::class, 'update'])->name('providers.profile.update');


Route::prefix('service-providers')->middleware(['provider'])->group(function () {



    Route::prefix('dashboard')->group(function () {


       
    
        Route::get('/', [DashboardController::class,'dashboard'])->name('service-provider.dashboard');




        Route::post('change-language', [DashboardController::class,'changeLanguage'])->name('service-provider.change-language');
      
    });
    Route::prefix('offers')->group(function () {
        Route::get('shop/{shop}', [OfferController::class,'show'])->name('shop');
        Route::get('/map', [OfferController::class,'index'])->name('service-provider.offers.pending');
        Route::get('/{offer}/display', [OfferController::class,'dispalyOffer'])->name('service-provider.offers.display');
        Route::get('/{offer}/status-accept', [OfferController::class,'changeStatusAccpetOffer'])->name('service-provider.offers.status.accept');
        Route::get('/accept', [OfferController::class,'acceptOffers'])->name('service-provider.offers.accept');
        Route::get('/owner/pending', [OfferController::class,'peindingOwnerOffers'])->name('service-provider.owner.offers.pending');
        Route::get('/owner/accept', [OfferController::class,'acceptOwnerOffers'])->name('service-provider.owner.offers.accept');

        Route::get('/create-offer', [OfferController::class,'createOffer'])->name('service-provider.estaes.create-offer');
        Route::get('/edit-offer/{offer}', [OfferController::class,'edit'])->name('service-provider.estaes.edit-offer');
        Route::get('/delete-offer/{offer}', [OfferController::class,'delete'])->name('service-provider.estaes.delete-offer');
        Route::put('/update-offer/{offer}', [OfferController::class,'update'])->name('service-provider.estaes.update-offer');
        Route::post('/store-offer', [OfferController::class,'storeOffer'])->name('service-provider.estaes.store-offer');


        Route::get('/payment/{offer_id}', [OfferController::class, 'payment'])->name('service-provider.estaes.payment');

    });



    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get(Profile::INDEX[URI], 'index')->name('index');
            Route::get(Profile::UPDATE[URI] . '/{id}', 'getUpdateView')->name('update');
            Route::post(Profile::UPDATE[URI] . '/{id}', 'update');
            Route::patch(Profile::UPDATE[URI] . '/{id}', 'updatePassword');
            Route::get(Profile::BANK_INFO_UPDATE[URI] . '/{id}', 'getBankInfoUpdateView')->name('update-bank-info');
            Route::post(Profile::BANK_INFO_UPDATE[URI] . '/{id}', 'updateBankInfo');
        });
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class,'display'])->name('service-provider.profile.dispaly');
        Route::put('/update/{user}', [ProfileController::class,'update'])->name('service-provider.profile.update');
    });

    // Route::prefix('estaes')->group(function () {
    Route::get('/', [EstaeController::class,'index'])->name('service-provider.estaes.index');

    // });


});