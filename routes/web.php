<?php

// Front End
Route::get('/',"FrontController@index");
Route::get('/page/{id}', "FrontPageController@index");
Route::get('/category/{id}', "FrontController@category");
Route::get('/sub-category/{id}', "FrontController@subcategory");
Route::get('/post/{id}', "FrontController@post");
Route::post('/send-email', "FrontController@send_email");
Route::get('/featured-work/{id}', "FrontController@featured_work");
Route::get('/location/get/{id}', "FrontController@get");
Auth::routes();

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
// Back End
Route::get('/admin',"HomeController@index");
Route::get('/admin/dashboard',"HomeController@index");

// load file manager
Route::get('/fm', "FileManagerController@index");

// featured work admin
Route::get('/admin/featured-work', "FeaturedWorkController@index");
Route::get('/admin/featured-work/create', "FeaturedWorkController@create");
Route::get('/admin/featured-work/edit/{id}', "FeaturedWorkController@edit");
Route::get('/admin/featured-work/delete/{id}', "FeaturedWorkController@delete");
Route::get('/admin/featured-work/view/{id}', "FeaturedWorkController@view");
Route::post('/admin/featured-work/save', "FeaturedWorkController@save");
Route::post('/admin/featured-work/update', "FeaturedWorkController@update");
// Post
Route::get('/admin/post', "PostController@index");
Route::get('/admin/post/create', "PostController@create");
Route::get('/admin/post/create', "PostController@create");
Route::post('/admin/post/save', "PostController@save");
Route::get('/admin/post/delete/{id}', "PostController@delete");
Route::get('/admin/post/edit/{id}', "PostController@edit");
Route::post('/admin/post/update', "PostController@update");
Route::get('/admin/post/view/{id}', "PostController@view");
// Page
Route::get('/admin/page', "PageController@index");
Route::get('/admin/page/create', "PageController@create");
Route::post('/admin/page/save', "PageController@save");
Route::get('/admin/page/delete/{id}', "PageController@delete");
Route::get('/admin/page/edit/{id}', "PageController@edit");
Route::post('/admin/page/update', "PageController@update");
Route::get('/admin/page/view/{id}', "PageController@view");
// Page
Route::get('/admin/our-service', "OurServiceController@index");
Route::get('/admin/our-service/edit/{id}', "OurServiceController@edit");
Route::post('/admin/our-service/update', "OurServiceController@update");
// catogory
Route::get('/admin/category', "CategoryController@index");
Route::get('/admin/category/create', "CategoryController@create");
Route::get('/admin/category/edit/{id}', "CategoryController@edit");
Route::get('/admin/category/delete/{id}', "CategoryController@delete");
Route::post('/admin/category/save', "CategoryController@save");
Route::post('/admin/category/update', "CategoryController@update");
//Main Menu
Route::get('/main-menu', "MainMenuController@index");
Route::get('/main-menu/create', "MainMenuController@create");
Route::post('/main-menu/save', "MainMenuController@save");
Route::get('/main-menu/delete/{id}', "MainMenuController@delete");
Route::get('/main-menu/edit/{id}', "MainMenuController@edit");
Route::post('/main-menu/update', "MainMenuController@update");

//Sub Menu
Route::get('/sub-menu', "SubMenuController@index");
Route::get('/sub-menu/create', "SubMenuController@create");
Route::post('/sub-menu/save', "SubMenuController@save");
Route::get('/sub-menu/delete/{id}', "SubMenuController@delete");
Route::get('/sub-menu/edit/{id}', "SubMenuController@edit");
Route::post('/sub-menu/update', "SubMenuController@update");
// user route
Route::get('/user', "UserController@index");
Route::get('/user/profile', "UserController@load_profile");
Route::get('/user/reset-password', "UserController@reset_password");
Route::post('/user/change-password', "UserController@change_password");
Route::get('/user/finish', "UserController@finish_page");
Route::post('/user/update-profile', "UserController@update_profile");
Route::get('/user/delete/{id}', "UserController@delete");
Route::get('/user/create', "UserController@create");
Route::post('/user/save', "UserController@save");
Route::get('/user/edit/{id}', "UserController@edit");
Route::post('/user/update', "UserController@update");
Route::get('/user/update-password/{id}', "UserController@load_password");
Route::post('/user/save-password', "UserController@update_password");

// role
Route::get('/role', "RoleController@index");
Route::get('/role/create', "RoleController@create");
Route::post('/role/save', "RoleController@save");
Route::get('/role/delete/{id}', "RoleController@delete");
Route::get('/role/edit/{id}', "RoleController@edit");
Route::post('/role/update', "RoleController@update");
Route::get('/role/permission/{id}', "PermissionController@index");
Route::post('/rolepermission/save', "PermissionController@save");
// Partner
Route::get('/partner', "PartnerController@index");
Route::get('/partner/create', "PartnerController@create");
Route::get('/partner/edit/{id}', "PartnerController@edit");
Route::get('/partner/delete/{id}', "PartnerController@delete");
Route::post('/partner/save', "PartnerController@save");
Route::post('/partner/update', "PartnerController@update");
// portfolio category
Route::get('/portfolio-category', "PortfolioCategoryController@index");
Route::get('/portfolio-category/create', "PortfolioCategoryController@create");
Route::get('/portfolio-category/edit/{id}', "PortfolioCategoryController@edit");
Route::get('/portfolio-category/delete/{id}', "PortfolioCategoryController@delete");
Route::post('/portfolio-category/save', "PortfolioCategoryController@save");
Route::post('/portfolio-category/update', "PortfolioCategoryController@update");
//Background Image
Route::get('/background-image', "BackgroundImageController@index");
Route::get('/background-image/edit/{id}', "BackgroundImageController@edit");
Route::post('/background-image/update', "BackgroundImageController@update");
// Partner
Route::get('/portfolio', "PortfolioController@index");
Route::get('/portfolio/create', "PortfolioController@create");
Route::get('/portfolio/edit/{id}', "PortfolioController@edit");
Route::get('/portfolio/delete/{id}', "PortfolioController@delete");
Route::post('/portfolio/save', "PortfolioController@save");
Route::post('/portfolio/update', "PortfolioController@update");

Route::get('/home', 'HomeController@index')->name('home');

// Slide 
Route::get('/slide', "SlideController@index");
Route::get('/slide/create', "SlideController@create");
Route::post('/slide/save', "SlideController@save");
Route::get('/slide/edit/{id}', "SlideController@edit");
Route::post('/slide/update', "SlideController@update");
Route::get('/slide/delete/{id}', "SlideController@delete");
// Current Project 
Route::get('/current-project', "CurrentProjectController@index");
Route::get('/current-project/create', "CurrentProjectController@create");
Route::post('/current-project/save', "CurrentProjectController@save");
Route::get('/current-project/edit/{id}', "CurrentProjectController@edit");
Route::post('/current-project/update', "CurrentProjectController@update");
Route::get('/current-project/delete/{id}', "CurrentProjectController@delete");
// Video
Route::get('/admin/video', "VideoController@index");
Route::get('/admin/video/create', "VideoController@create");
Route::post('/admin/video/save', "VideoController@save");
Route::get('/admin/video/edit/{id}', "VideoController@edit");
Route::post('/admin/video/update', "VideoController@update");
Route::get('/admin/video/delete/{id}', "VideoController@delete");
// Social
Route::get('/social', "SocialController@index");
Route::get('/social/create', "SocialController@create");
Route::post('/social/save', "SocialController@save");
Route::get('/social/edit/{id}', "SocialController@edit");
Route::post('/social/update', "SocialController@update");
Route::get('/social/delete/{id}', "SocialController@delete");
// Advertisement
Route::get('/advertisement', "AdvertisementController@index");
Route::get('/advertisement/create', "AdvertisementController@create");
Route::post('/advertisement/save', "AdvertisementController@save");
Route::get('/advertisement/edit/{id}', "AdvertisementController@edit");
Route::post('/advertisement/update', "AdvertisementController@update");
Route::get('/advertisement/delete/{id}', "AdvertisementController@delete");
// Company Feature
Route::get('/company-feature', "CompanyFeatureController@index");
Route::get('/company-feature/create', "CompanyFeatureController@create");
Route::post('/company-feature/save', "CompanyFeatureController@save");
Route::get('/company-feature/edit/{id}', "CompanyFeatureController@edit");
Route::post('/company-feature/update', "CompanyFeatureController@update");
Route::get('/company-feature/delete/{id}', "CompanyFeatureController@delete");

// project location
Route::get('/admin/project-location', 'ProjectLocationController@index');
Route::get('/admin/project-location/create', 'ProjectLocationController@create');
Route::get('/admin/project-location/edit/{id}', 'ProjectLocationController@edit');
Route::get('/admin/project-location/delete/{id}', 'ProjectLocationController@delete');
Route::post('/admin/project-location/save', 'ProjectLocationController@save');
Route::post('/admin/project-location/update', 'ProjectLocationController@update');

// video category
Route::get('/admin/video-category', "VideoCategoryController@index");
Route::get('/admin/video-category/create', "VideoCategoryController@create");
Route::get('/admin/video-category/edit/{id}', "VideoCategoryController@edit");
Route::get('/admin/video-category/delete/{id}', "VideoCategoryController@delete");
Route::post('/admin/video-category/save', "VideoCategoryController@save");
Route::post('/admin/video-category/update', "VideoCategoryController@update");
// region
Route::get('/admin/region', "RegionController@index");
Route::get('/admin/region/create', "RegionController@create");
Route::get('/admin/region/edit/{id}', "RegionController@edit");
Route::get('/admin/region/delete/{id}', "RegionController@delete");
Route::post('/admin/region/save', "RegionController@save");
Route::post('/admin/region/update', "RegionController@update");