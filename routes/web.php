<?php

use Illuminate\Support\Facades\Route;

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index']);

route::get('/shape/{category_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewCategoryPost']);
route::get('/shape/{category_slug}/{post_slug}', [App\Http\Controllers\Frontend\FrontendController::class, 'viewPost']);



Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    
    Route::get('/log-activity', [App\Http\Controllers\Admin\LogActivityController::class, 'logActivity']);
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/categories',[App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::get('/add-category',[App\Http\Controllers\Admin\CategoryController::class, 'add']);
    Route::post('/add-category',[App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::get('/delete-category/{id?}',[App\Http\Controllers\Admin\CategoryController::class, 'delete'])->where('id','[0-9]+');
    Route::get('/edit-category/{id?}',[App\Http\Controllers\Admin\CategoryController::class, 'edit'])->where('id','[0-9]+');
    Route::put('/update-category/{id?}',[App\Http\Controllers\Admin\CategoryController::class, 'update'])->where('id','[0-9]+');

    Route::get('/posts', [App\Http\Controllers\Admin\PostsController::class, 'index']);
    Route::get('/add-post', [App\Http\Controllers\Admin\PostsController::class, 'add']);
    Route::post('/add-post', [App\Http\Controllers\Admin\PostsController::class, 'create']);
    Route::get('/delete-post/{id?}', [App\Http\Controllers\Admin\PostsController::class, 'delete'])->where('id','[0-9]+');
    Route::post('/delete-posts', [App\Http\Controllers\Admin\PostsController::class, 'deleteall']);
    Route::get('/edit-post/{id?}', [App\Http\Controllers\Admin\PostsController::class,'edit'])->where('id','[0-9]+');
    Route::put('/update-post/{id?}', [App\Http\Controllers\Admin\PostsController::class, 'update'])->where('id','[0-9]+');
    Route::get('/exportxlsx-posts', [App\Http\Controllers\Admin\PostsController::class, 'exportXlsx']);
    Route::get('/exportpdf-posts', [App\Http\Controllers\Admin\PostsController::class, 'exportPdf']);
    Route::get('/exportdoc-posts', [App\Http\Controllers\Admin\PostsController::class, 'exportDoc']);
    Route::get('/json-posts', [App\Http\Controllers\Admin\PostsController::class, 'getjson']);

    Route::get('/create-mail', [App\Http\Controllers\Admin\MailsController::class, 'createmail']);
    Route::post('/send-mail', [App\Http\Controllers\Admin\MailsController::class, 'sendmail']);

    //Route::post('/lang/{lang}', [App\Http\Controllers\Admin\LanguageController::class, 'switchLang']);

    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\Admin\LanguageController@switchLang']);


});
