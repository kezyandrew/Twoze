<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/settings', 'api\UserApiController@settings'); // partly done


Route::post('/login', 'api\UserApiController@login'); // done
Route::post('/register', 'api\UserApiController@register'); // done
Route::post('/sendOtp', 'api\UserApiController@sendotp'); // done
Route::post('/checkOtp', 'api\UserApiController@checkotp'); // done
Route::post('/changePassword', 'api\UserApiController@changePassword'); // done

Route::get('/offers', 'api\UserApiController@offers'); // done

Route::get('/coupons', 'api\UserApiController@coupons'); // done
Route::post('/checkCoupon', 'api\UserApiController@checkCoupon');  // done

Route::get('/services', 'api\UserApiController@services'); // done

Route::post('/service_product', 'api\UserApiController@service_product'); // done


Route::middleware('auth:api')->group(function()
{
    Route::get('/profile', 'api\UserApiController@profile'); // done
    Route::post('/profile_edit', 'api\UserApiController@profile_edit'); // done
    Route::post('/profile_edit_image', 'api\UserApiController@profile_edit_image'); // done

    Route::post('/add_address', 'api\UserApiController@add_address'); // done
    Route::get('/all_address', 'api\UserApiController@all_address');  // done
    Route::get('/remove_address/{id}', 'api\UserApiController@remove_address'); // done

    Route::post('/order', 'api\UserApiController@order'); // done
    Route::get('/singleOrder/{id}', 'api\UserApiController@singleOrder'); // done
    Route::get('/allOrders', 'api\UserApiController@allOrders'); // done
    Route::get('/cancelOrder/{id}', 'api\UserApiController@cancelOrder'); // done
    Route::get('/activeOrder', 'api\UserApiController@activeOrder'); // done

    Route::get('/payment', 'api\UserApiController@payment'); // done

});