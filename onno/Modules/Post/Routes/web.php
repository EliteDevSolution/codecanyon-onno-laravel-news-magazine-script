<?php

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
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'isInstalledCheck']
    ],
    function () {
    Route::prefix('post')->group(function() {
        Route::group(['middleware'=>['loginCheck']],function(){

            Route::group(['middleware' => ['XSS']], function () {

                //post
                Route::get('/', 'PostController@index')->name('post')->middleware('permissionCheck:post_read');

                Route::get('/create/article', 'PostController@createArticle')->name('create-article')->middleware('permissionCheck:post_write');
                Route::get('/create/video', 'PostController@createVideoPost')->name('create-video-post')->middleware('permissionCheck:post_write');
                
                Route::get('/edit/{type}/{id}', 'PostController@editPost')->name('edit-post')->middleware('permissionCheck:post_write');
                

                Route::delete('/remove-post-form', 'PostController@removePostFrom')->name('remove-post-form')->middleware('permissionCheck:post_write');

                Route::post('/add-to', 'PostController@addPostTo')->name('add-to')->middleware('permissionCheck:post_write');
                Route::post('/update/slider-order', 'PostController@updateSliderOrder')->name('update-slider-order')->middleware('permissionCheck:post_write');
                Route::post('/update/featured-order', 'PostController@updateFeaturedOrder')->name('update-featured-order')->middleware('permissionCheck:post_write');
                Route::post('/update/breaking-order', 'PostController@updateBreakingOrder')->name('update-breaking-order')->middleware('permissionCheck:post_write');
                Route::post('/update/recommended-order', 'PostController@updateRecommendedOrder')->name('update-recommended-order')->middleware('permissionCheck:post_write');

                Route::get('/slider', 'PostController@slider')->name('slider-posts')->middleware('permissionCheck:post_read');
                Route::get('/featured', 'PostController@featuredPosts')->name('featured-posts')->middleware('permissionCheck:post_read');
                Route::get('/breaking', 'PostController@breakingPosts')->name('breaking-posts')->middleware('permissionCheck:post_read');

                Route::get('/recommended', 'PostController@recommendedPosts')->name('recommended-posts')->middleware('permissionCheck:post_read');

                Route::get('/editor-picks', 'PostController@editorPicksPosts')->name('editor-picks')->middleware('permissionCheck:post_read');

                Route::get('/pending', 'PostController@pendingPosts')->name('pending-posts')->middleware('permissionCheck:post_read');
                Route::get('/submitted', 'PostController@submittedPosts')->name('submitted-posts')->middleware('permissionCheck:post_read');

                Route::get('/submitted', 'PostController@submittedPosts')->name('submitted-posts')->middleware('permissionCheck:post_read');


                Route::post('/categories/fetch', 'PostController@fetchCategory')->name('category-fetch')->middleware('permissionCheck:post_read');

                Route::post('/sub-categories/fetch', 'PostController@fetchSubcategory')->name('subcategory-fetch')->middleware('permissionCheck:post_read');

                //filter
                Route::get('/filter', 'PostController@filterPost')->name('filter-post')->middleware('permissionCheck:post_read');

                //category
                Route::get('/categories', 'CategoryController@categories')->name('categories')->middleware('permissionCheck:category_read');
                Route::post('/categories/add', 'CategoryController@saveNewCategory')->name('save-new-category')->middleware('permissionCheck:category_write');
                Route::get('/categories/edit/{id}', 'CategoryController@editCategory')->name('edit-category')->middleware('permissionCheck:category_write');
                Route::post('/categories/update', 'CategoryController@updateCategory')->name('update-category')->middleware('permissionCheck:category_write');

                //subcategory
                Route::get('/sub-categories', 'CategoryController@subCategories')->name('sub-categories')->middleware('permissionCheck:sub_category_read');
                Route::post('/sub-categories', 'CategoryController@subCategoriesAdd')->name('save-new-sub-category')->middleware('permissionCheck:sub_category_write');
                Route::get('/sub-categories/edit/{id}', 'CategoryController@editSubCategory')->name('edit-sub-category')->middleware('permissionCheck:sub_category_write');
                Route::post('/sub-categories/update', 'CategoryController@updateSubCategory')->name('update-sub-category')->middleware('permissionCheck:sub_category_write');

                //poll
                Route::get('/polls', 'PollController@polls')->name('polls')->middleware('permissionCheck:polls_read');
                Route::get('/poll/create', 'PollController@create')->name('create-poll')->middleware('permissionCheck:polls_write');
                Route::post('/poll/store', 'PollController@store')->name('store-poll')->middleware('permissionCheck:polls_write');
                Route::get('/poll/edit/{id}', 'PollController@edit')->name('poll-edit')->middleware('permissionCheck:polls_write');
                Route::put('/poll/update/{id}', 'PollController@update')->name('update-poll')->middleware('permissionCheck:polls_write');

                //comments
                Route::get('/comments', 'CommentsController@Comments')->name('comments')->middleware('permissionCheck:comments_read');
                Route::get('/comment/setting', 'CommentsController@index')->name('setting-comment')->middleware('permissionCheck:comments_write');
                Route::post('/update/comment-setting', 'CommentsController@updateCommentSettings')->name('update-comment-settings')->middleware('permissionCheck:comments_write');
            });

            Route::post('/save/new-post/{type}', 'PostController@saveNewPost')->name('save-new-post')->middleware('permissionCheck:post_write');
            Route::post('/update/{type}/{id}', 'PostController@updatePost')->name('update-post')->middleware('permissionCheck:post_write');


        });
    });
});
