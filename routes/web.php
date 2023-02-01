<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\ConfigsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CouponsController as AdminCouponsController;
use App\Http\Controllers\Admin\DimensionsController;
use App\Http\Controllers\Admin\ImagesController;
use App\Http\Controllers\Admin\MessagesController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentsController as AdminPaymentsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SizesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutConttoller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripeWebhooksController;
use App\Http\Controllers\WishListController;
use App\Http\Middleware\AdminMiddleware;
use App\Jobs\SendEmailToUserToPayOrder as JobsSendEmailToUserToPayOrder;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use App\Models\WishList;
use App\Notifications\SendEmailToUserToPayOrder;
use App\Notifications\WishListNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Intl\Countries;
use Vonage\Verify\Check;

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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', ])->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth','verified']], function (){
    Route::prefix('admin')
        ->middleware(['middleware' => AdminMiddleware::class])
        ->group(function () {
            Route::resource('categories', CategoriesController::class);
            Route::resource('products', ProductsController::class);
            Route::resource('notifications', NotificationsController::class);
            Route::get('/batch/{id}', [NotificationsController::class, 'getBatch']);
            Route::get('contact-us', [ContactUsController::class, 'create'])->name('contact.create');
            Route::post('contact-us', [ContactUsController::class, 'update'])->name('contact.update');
            Route::get('about-us', [AdminAboutUsController::class, 'create'])->name('aboutUs.create');
            Route::post('about-us', [AdminAboutUsController::class, 'update'])->name('aboutUs.update');
            Route::get('settings', [ConfigsController::class, 'create'])->name('settings');
            Route::post('settings', [ConfigsController::class, 'store']);
            Route::get('payments', [AdminPaymentsController::class , 'index'])->name('payments.index');
            Route::get('payment/{id}', [AdminPaymentsController::class , 'show'])->name('payments.show');
            Route::resource('roles', RolesController::class);
            Route::resource('brands', BrandsController::class);
            Route::resource('colors', ColorsController::class);
            Route::resource('coupons', AdminCouponsController::class);
            Route::resource('orders', OrdersController::class);
            Route::resource('dimensions', DimensionsController::class);
            Route::resource('tags', TagsController::class);
            Route::resource('sizes', SizesController::class);
            Route::resource('users', UsersController::class);
            Route::resource('messages', MessagesController::class);
            
        });
        Route::get('/profile', [HomeController::class, 'getProfile'])->name('profile');
        Route::post('/ratigns', [RatingsController::class, 'store'])->name('rating.store');
        Route::post('/coupon/remove/{id}', [CouponsController::class, 'removeCoupon'])->name('coupons.remove');
        Route::post('/coupons', [CouponsController::class, 'store'])->name('coupons.apply');
});

Route::post('wishlist', [WishListController::class, 'storeWishList'])->name('wishlist.store');
Route::get('wishlist', [WishListController::class, 'index'])->name('wishlist');
Route::delete('wishlist/{id}', [WishListController::class, 'deleteProductFromCookie'])->name('wishlist.delete');


Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

Route::get('/about-us', [AboutUsController::class, 'index'])->name('about.index');


Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('product/{slug}', [ProductController::class, 'show'])->name('single.product');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::post('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart.delete');

Route::get('/checkout', [CheckoutConttoller::class, 'create'])->name('checkout');
Route::post('/checkout', [CheckoutConttoller::class, 'store']);

Route::get('/orders', [CheckoutConttoller::class, 'index'])->name('orders');
Route::delete('/orders/{id}', [CheckoutConttoller::class, 'delete'])->name('order.delete');
Route::get('orders/{order}/pay', [PaymentsController::class, 'createPayment'])->name('orders.payments.create');
Route::any('orders/{order}/payment-intent', [PaymentsController::class, 'create'])->name('orders.paymentIntent.create');
Route::get('orders/{order}/payment-intent/callback', [PaymentsController::class, 'confirm'])->name('orders.payments.return');
Route::get('orders/{order}/payment-intent/cancel', [PaymentsController::class, 'cancel'])->name('orders.payments.cancel');


Route::get('/search', [SearchController::class, 'search'])->name('search');



Route::get('/test', function(){

    $product = Product::with(['category' => function($q){
        $q->select('id', 'name');
    }, 'brands', 'dimensions'])->get();

    return ($product);    
});