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

Route::get('/', 'Frontend\HomeController@index')->name('index');
Route::get('/home', 'Frontend\HomeController@index')->name('home');

Auth::routes(['verify' => true]);
Route::resource('contact-us', 'Backend\ContactUsController');
Route::resource('divisions', 'Locations\DivisionController');
Route::resource('districts', 'Locations\DistrictController');
Route::resource('upazilas', 'Locations\UpazilaController');
Route::resource('unions', 'Locations\UnionController');
Route::resource('orders', 'Backend\OrderController');
Route::get('cart', 'Backend\OrderController@cart')->name('cart');
Route::get('checkout', 'Backend\OrderController@checkout')->name('checkout');
Route::get('order-complete', 'Backend\OrderController@orderComplete')->name('order-complete');
Route::get('card-payment/{id}', 'Frontend\StripePaymentController@stripe')->name('card-payment');
Route::post('stripe', 'Frontend\StripePaymentController@stripePost')->name('stripe.post');

Route::get('login/{social}', 'Backend\SocialLoginController@redirectToProvider')->name('social.callback');
Route::get('login/{social}/callback', 'Backend\SocialLoginController@handleProviderCallback')->name('social.redirect');
Route::get('privacy-policy', 'Frontend\HomeController@privacyPolicy')->name('privacy-policy');
Route::get('terms-conditions', 'Frontend\HomeController@privacyPolicy')->name('terms-conditions');

//Routes for dashboard
Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::resource('cashbooks', 'Backend\CashbookController');
	Route::resource('categories', 'Backend\CategoryController')->middleware('moderator:Category');
	Route::resource('chats', 'Backend\ChatController');
	Route::get('checkout-login', 'Backend\OrderController@checkoutLogin')->name('checkout-login');
	Route::resource('colors', 'Backend\ColorController')->middleware('moderator:Color');
	Route::get('/dashboard', 'Backend\DashboardController@dashboard')->name('dashboard');
	Route::resource('home-sliders', 'Backend\ColorController')->middleware('moderator:Color');
	Route::resource('notifications', 'Backend\NotificationController');
	Route::get('notifications-all', 'Backend\NotificationController@all')->name('notifications.all');
	Route::resource('order-details', 'Backend\OrderDetailController');
	Route::get('orders-incomplete', 'Backend\OrderController@incomplete')->name('orders.incomplete');
	Route::resource('order-statuses', 'Backend\OrderStatusController')->middleware('moderator:Order Status');
	Route::get('orders-user', 'Backend\OrderController@user')->name('orders.user');
	Route::resource('payments', 'Backend\PaymentController')->middleware('moderator:Payment');
	Route::resource('permissions', 'Backend\PermissionController')->middleware('moderator:Permission');
	Route::put('permissions-update', 'Backend\PermissionController@updateList')->name('permissions.update.list')->middleware('moderator:Permission');
	Route::get('manage-products', 'Backend\ProductController@manageIndex')->name('manage-products.index')->middleware('moderator:Product');;
    Route::resource('manage-products', 'Backend\ProductController')->except(['index', 'show'])->middleware('moderator:Product');;
	Route::resource('regions', 'Locations\RegionController')->middleware('moderator:Location');
	Route::resource('shippers', 'Backend\ShipperController')->middleware('moderator:Shipper');
	Route::resource('sizes', 'Backend\SizeController')->middleware('moderator:Size');
	Route::resource('suppliers', 'Backend\SupplierController')->middleware('moderator:Supplier');
	Route::resource('units', 'Backend\UnitController')->middleware('moderator:Unit');
	Route::resource('users', 'Backend\UserController');
});
Route::resource('products', 'Backend\ProductController')->only(['index', 'show']);
Route::post('subscriptions', 'Backend\ContactUsController@subscribe')->name('subscriptions.store');
Route::get('sitemap.xml', function() {

	\Spatie\Sitemap\SitemapGenerator::create('https://onbiponi.com')->writeToFile('sitemap.xml');
	});
Route::get('/clear-cache', function() {
		Artisan::call('cache:clear');
		Artisan::call('view:clear');
		return redirect('/');
	});
