<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\OrderController;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('/saveEnvData', [LoginController::class, 'saveEnvData']);

Route::get('/adminlogin', [LoginController::class, 'admin_login']);
Route::get('/login', [LoginController::class, 'admin_login']);
Route::get('/', [LoginController::class, 'admin_login']);
Route::post('/admin_login_check', [LoginController::class, 'admin_login_check']);

// Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware'=> ['auth']], function(){
//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });


Route::prefix('/admin')->middleware(['auth'])->group(function()
{
    Route::get('/logout', [LoginController::class, 'admin_logout']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::resources([
            'role' => Admin\RoleController::class,
            'user' => Admin\UserController::class,
            'offer' => Admin\OfferController::class,
            'service' => Admin\ServiceController::class,
            'product' => Admin\ProductController::class,
            'coupon' => Admin\CouponController::class,
            'order' => Admin\OrderController::class,
            'language' => Admin\LanguageController::class,
    ]);

    Route::get('/revenueWeekData', 'admin\DashboardController@revenueWeekData');
    Route::get('/revenueMonthData', 'admin\DashboardController@revenueMonthData');
    Route::get('/revenueYearData', 'admin\DashboardController@revenueYearData');
    Route::get('/userData', 'admin\DashboardController@userData');

    Route::get('/profile/{id}', [ProfileController::class, 'admin_show']);
    Route::post('/profile/update/{id}', [ProfileController::class, 'admin_update']);
    Route::post('/profile/changepassword/{id}', [ProfileController::class, 'admin_changePassword']);

    Route::get('/setting', [SettingController::class, 'setting']);
    Route::post('/setting/otp', [SettingController::class, 'setting_otp']);
    Route::post('/setting/currency', [SettingController::class, 'currency']);
    Route::post('/setting/map', [SettingController::class, 'map']);
    Route::post('/setting/address', [SettingController::class, 'address']);
    Route::post('/setting/push_notification', [SettingController::class, 'push_notification']);
    Route::post('/setting/email_settings', [SettingController::class, 'email_settings']);
    Route::post('/setting/sms_gateway', [SettingController::class, 'sms_gateway']);
    Route::post('/setting/payment_gateway', [SettingController::class, 'payment_gateway']);
    Route::post('/setting/terms_of_use', [SettingController::class, 'terms_of_use']);
    Route::post('/setting/privacy_policy', [SettingController::class, 'privacy_policy']);
    Route::post('/setting/app_setting', [SettingController::class, 'app_setting']);
    Route::post('/setting/admin_settings', [SettingController::class, 'admin_settings']);
    Route::post('/setting/license', [SettingController::class, 'license']);

    Route::get('/notification/template', [NotificationController::class, 'template']);
    Route::get('/notification/template/edit/{id}', [NotificationController::class, 'template_edit']);
    Route::post('/notification/template/update/{id}', [NotificationController::class, 'template_update']);
    Route::get('/notification/send', [NotificationController::class, 'send']);
    Route::post('/notification/store', [NotificationController::class, 'store']);

    Route::get('/order/invoice/{id}', [InvoiceController::class, 'invoice']);
    Route::get('/order/invoice/print/{id}', [InvoiceController::class, 'invoice_print']);
    

    Route::get('/report/usersReport', [ReportController::class, 'users']);
    Route::post('/report/usersReport/filter', [ReportController::class, 'usersFilter']);
    Route::get('/report/revenueReport', [ReportController::class, 'revenueReport']);
    Route::post('/report/revenueReport/filter', [ReportController::class, 'revenueReportFilter']);

    Route::get('/calendar', [CalendarController::class, 'index']);

    Route::post('/order/changeStatus', [OrderController::class, 'changeStatus']);

});
