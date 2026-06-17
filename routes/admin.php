<?php


use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\AgentController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ConversationController;
use App\Http\Controllers\Dashboard\EstateController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\OfferController;
use App\Http\Controllers\Dashboard\OfferOperationController;
use App\Http\Controllers\Dashboard\PackageController;
use App\Http\Controllers\Dashboard\PropertyController;
use App\Http\Controllers\Dashboard\ProvinceController;
use App\Http\Controllers\Dashboard\ServiceProviderController;
use App\Http\Controllers\Dashboard\ServiceTypeController;
use App\Http\Controllers\Dashboard\setting\PermissionController;
use App\Http\Controllers\Dashboard\setting\RoleController;
use App\Http\Controllers\Dashboard\setting\StatusController;
use App\Http\Controllers\Dashboard\TerritoryController;
use App\Http\Controllers\Dashboard\ZoneController;
use App\Http\Controllers\SharedController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Auth\LoginController;









// Route::group(['prefix' => 'login'], function () {
//     Route::get('{loginUrl}', [LoginController::class, 'index']);
//     Route::get('recaptcha/{tmp}', [LoginController::class, 'generateReCaptcha'])->name('recaptcha');
//     Route::post('/', [LoginController::class, 'login'])->name('login');
// });
Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::prefix('/settings/admins')->group(function () {
        Route::get('/', [AdminController::class,'index'])->name('admins.index');
        Route::get('/create', [AdminController::class,'create'])->name('admins.create');
        Route::get('/edit/{admin}', [AdminController::class,'edit'])->name('admins.edit');
        Route::post('/store', [AdminController::class,'store'])->name('admins.store');
        Route::put('/update/{admin}', [AdminController::class,'update'])->name('admins.update');
    });
    Route::prefix('/settings/roles')->group(function () {
        Route::get('/', [RoleController::class,'index'])->name('roles.index');
        Route::get('/create', [RoleController::class,'create'])->name('roles.create');
        Route::get('/edit/{role}', [RoleController::class,'edit'])->name('roles.edit');
        Route::post('/store', [RoleController::class,'store'])->name('roles.store');
        Route::put('/update/{role}', [RoleController::class,'update'])->name('roles.update');
    });

    Route::prefix('/settings/permissions')->group(function () {
        Route::get('/', [PermissionController::class,'index'])->name('permissions.index');
        Route::get('/edit/{permission}', [PermissionController::class,'edit'])->name('permissions.edit');
        Route::post('/store', [PermissionController::class,'store'])->name('permissions.store');
        Route::put('/update/{permission}', [PermissionController::class,'update'])->name('permissions.update');
    });


    Route::prefix('/settings')->group(function () {
        Route::get('/change-status/{user}', [StatusController::class,'changeStatus'])->name('change-status');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class,'index'])->name('categories.index');
        Route::post('/store', [CategoryController::class,'store'])->name('categories.store');
        Route::get('/edit/{category}', [CategoryController::class,'edit'])->name('categories.edit');
        Route::put('/update/{category}', [CategoryController::class,'update'])->name('categories.update');
        Route::get('/sub', [CategoryController::class,'indexSubCategories'])->name('categories.sub-categories');
    });

    Route::prefix('properties')->group(function () {
        Route::get('/', [PropertyController::class,'index'])->name('properties.index');
        Route::post('/store', [PropertyController::class,'store'])->name('properties.store');
        Route::get('/edit/{property}', [PropertyController::class,'edit'])->name('properties.edit');
        Route::put('/update/{property}', [PropertyController::class,'update'])->name('properties.update');
    });

    Route::prefix('territories')->group(function () {
        Route::get('/', [TerritoryController::class,'index'])->name('territories.index');
        Route::post('/store', [TerritoryController::class,'store'])->name('territories.store');
        Route::get('/edit/{territory}', [TerritoryController::class,'edit'])->name('territories.edit');
        Route::put('/update/{territory}', [TerritoryController::class,'update'])->name('territories.update');
    });

    Route::prefix('zones')->group(function () {
        Route::get('/', [ZoneController::class,'index'])->name('zones.index');
        Route::get('/create', [ZoneController::class,'create'])->name('zones.create');
        Route::post('/store', [ZoneController::class,'store'])->name('zones.store');
        Route::get('/edit/{zone}', [ZoneController::class,'edit'])->name('zones.edit');
        Route::put('/update/{zone}', [ZoneController::class,'update'])->name('zones.update');
    });

    Route::prefix('provinces')->group(function () {
        Route::get('/', [ProvinceController::class,'index'])->name('provinces.index');
        Route::post('/store', [ProvinceController::class,'store'])->name('provinces.store');
        Route::get('/edit/{province}', [ProvinceController::class,'edit'])->name('provinces.edit');
        Route::put('/update/{province}', [ProvinceController::class,'update'])->name('provinces.update');
    });

    Route::prefix('service-providers')->group(function () {
        Route::get('/', [ServiceProviderController::class,'index'])->name('service-providers.index');
        Route::get('/create', [ServiceProviderController::class,'create'])->name('service-providers.create');
        Route::post('/store', [ServiceProviderController::class,'store'])->name('service-providers.store');
        Route::get('/edit/{user}', [ServiceProviderController::class,'edit'])->name('service-providers.edit');
        Route::put('/update/{user}', [ServiceProviderController::class,'update'])->name('service-providers.update');
        
        
    // ✅ أضف هذا
Route::post('/service-provider/offers/{offer}/toggle-status', [OfferController::class, 'toggleStatus'])
    ->name('service-provider.offers.toggle-status');
        
        

    
    
    
    });

    Route::prefix('agents')->group(function () {
        Route::get('/', [AgentController::class,'index'])->name('agents.index');
        Route::get('/create', [AgentController::class,'create'])->name('agents.create');
        Route::post('/store', [AgentController::class,'store'])->name('agents.store');
        Route::get('/edit/{user}', [AgentController::class,'edit'])->name('agents.edit');
        Route::put('/update/{user}', [AgentController::class,'update'])->name('agents.update');


        Route::get('/real-estate-offices', [AgentController::class,'getRealEstateOfficesAgents'])->name('agents.real-estate-offices');
        Route::get('/real-estate-companies', [AgentController::class,'getRealEstateCompaniesAgents'])->name('agents.real-estate-companies');
        Route::get('/individuals', [AgentController::class,'getIndividualsAgents'])->name('agents.individuals');
    });

    Route::prefix('service-types')->group(function () {
        Route::get('/', [ServiceTypeController::class,'index'])->name('service-types.index');
        // Route::get('/getServiceTypes', [ServiceTypeController::class,'getServiceTypes'])->name('getServiceTypes');
        Route::post('/store', [ServiceTypeController::class,'store'])->name('service-types.store');
        Route::get('/edit/{serviceType}', [ServiceTypeController::class,'edit'])->name('service-types.edit');
        Route::put('/update/{serviceType}', [ServiceTypeController::class,'update'])->name('service-types.update');
    });


    Route::prefix('offers')->group(function () {
        Route::get('/', [OfferController::class,'index'])->name('offers.index');
        Route::get('/create', [OfferController::class,'create'])->name('offers.create');
        Route::post('/store', [OfferController::class,'store'])->name('offers.store');
        Route::get('/edit/{offer}', [OfferController::class,'edit'])->name('offers.edit');
        Route::put('/update/{offer}', [OfferController::class,'update'])->name('offers.update');

        Route::get('/{offer}/send-offer', [OfferOperationController::class,'sendOfferPage'])->name('send.offer.page');
        Route::post('/{offer}/send-offer', [OfferOperationController::class,'sendedOffer'])->name('send.offer.page.post');
        Route::get('/sent', [OfferOperationController::class,'getOffersSent'])->name('offers.sent');
    });

    Route::prefix('notification')->group(function () {
        Route::get('add-new', [NotificationController::class,'index'])->name('notification.create');
        Route::post('store', [NotificationController::class,'store'])->name('notification.store');
    });

    Route::prefix('banners')->group(function () {
        Route::get('/', [BannerController::class,'index'])->name('banners.index');
        Route::post('store', [BannerController::class,'store'])->name('banners.store');
        Route::delete('delete/{banner}', [BannerController::class,'delete'])->name('banners.delete');
    });


    Route::prefix('/packages')->group(function () {
        Route::get('/', [PackageController::class,'index'])->name('packages.index');
        Route::get('/create', [PackageController::class,'create'])->name('packages.create');
        Route::post('/store', [PackageController::class,'store'])->name('packages.store');
        Route::get('/edit/{package}', [PackageController::class,'edit'])->name('packages.edit');
        Route::put('/update/{package}', [PackageController::class,'update'])->name('packages.update');

    });


    Route::prefix('/message')->group(function () {
        Route::get('/list', [ConversationController::class,'list'])->name('message.list');
        Route::post('store/{user_id}', [ConversationController::class,'store'])->name('message.store');
        Route::get('view/{conversation_id}/{user_id}', [ConversationController::class,'view'])->name('message.view');
    });

    Route::prefix('/estate')->group(function () {
        Route::get('/', [EstateController::class,'index'])->name('estate.index');
        Route::get('/create', [EstateController::class,'create'])->name('estate.create');
        Route::post('store', [EstateController::class,'store'])->name('estate.store');
        Route::get('/edit/{package}', [EstateController::class,'edit'])->name('estate.edit');
        Route::put('/update/{package}', [EstateController::class,'update'])->name('estate.update');

    });


    Route::prefix('/business-settings')->group(function () {
        Route::get('/', [EstateController::class,'index'])->name('estate.index');
        Route::get('/create', [EstateController::class,'create'])->name('estate.create');
        Route::post('store', [EstateController::class,'store'])->name('estate.store');
        Route::get('/edit/{package}', [EstateController::class,'edit'])->name('estate.edit');
        Route::put('/update/{package}', [EstateController::class,'update'])->name('estate.update');

    });

});
