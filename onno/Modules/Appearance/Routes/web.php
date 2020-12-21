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

    Route::prefix('appearance')->group(function() {
        Route::group(['middleware' => ['loginCheck']], function () {
            Route::group(['middleware' => ['XSS']], function () {
                Route::post('/menu/add', 'MenuController@addMenu')->name('add-menu')->middleware('permissionCheck:menu_write');
                Route::post('/menu/update', 'MenuController@updateMenu')->name('update-menu')->middleware('permissionCheck:menu_write');
                Route::post('/menu-location/update', 'MenuController@updateMenuLocation')->name('save-menu-locations')->middleware('permissionCheck:menu_write');

                route::get('menu-item', 'MenuItemController@menuItem')->name('menu-item')->middleware('permissionCheck:menu_read');
                route::get('search-menu-item', 'MenuItemController@menuItemSearch')->name('search-menu-item')->middleware('permissionCheck:menu_read');
                route::post('menu-item/save', 'MenuItemController@menuItemSave')->name('save-menu-item')->middleware('permissionCheck:menu_item_write');

                route::post('menu-item/update', 'MenuItemController@menuItemUpdate')->name('update-menu-item')->middleware('permissionCheck:menu_item_write');
                route::delete('menu-item/delete', 'MenuItemController@menuItemDelete')->name('delete-menu-item')->middleware('permissionCheck:menu_item_delete');

                //change order on ajax
                route::post('change-menu-order', 'MenuItemController@changeMenuOrder')->name('change-menu-order')->middleware('permissionCheck:menu_item_write');

                //theme
                route::get('themes', 'ThemeController@themes')->name('themes')->middleware('permissionCheck:theme_section_read');
                route::post('themes/current/update', 'ThemeController@updateCurrentTheme')->name('update-current-theme')->middleware('permissionCheck:theme_section_write');
                route::post('primary-section/update', 'ThemeController@updatePrimarySection')->name('update-primary-section')->middleware('permissionCheck:theme_section_write');

                route::get('theme-options', 'ThemeController@themeOption')->name('themes-options')->middleware('permissionCheck:theme_section_read');
                route::post('update/theme-option', 'ThemeController@updateThemeOption')->name('update-theme-option')->middleware('permissionCheck:theme_section_write');

                //sections
                route::get('sections', 'ThemeSectionController@sections')->name('sections')->middleware('permissionCheck:theme_section_read');
                route::post('save/section', 'ThemeSectionController@saveNewSection')->name('save-new-section')->middleware('permissionCheck:theme_section_write');
                route::get('edit/theme/section/{id}', 'ThemeSectionController@editThemeSection')->name('edit-theme-section')->middleware('permissionCheck:theme_section_write');
                route::post('update/theme/section', 'ThemeSectionController@updateThemeSection')->name('update-theme-section')->middleware('permissionCheck:theme_section_write');

                route::post('update-section-order', 'ThemeSectionController@updateSectionOrder')->name('update-section-order')->middleware('permissionCheck:theme_section_write');

            });
        });
    });
});
