<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = 'order';
    public $primaryKey = 'id';
    public $timestamps = true;
    
    protected $appends = ['orderChild'];
    
    public function getOrderChildAttribute()
    {
        return OrderChild::where('order_id',$this->attributes['id'])->get();
    }
    
    public function address()
    {
        return $this->hasOne(Address::class,'id','addr_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function coupon()
    {
        return $this->hasOne(Coupon::class,'id','coupon_id');
    }
    
}
