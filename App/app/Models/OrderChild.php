<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderChild extends Model
{
    use HasFactory;
    
    protected $table = 'order_child';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $appends = ['products','serviceName'];

    public function getProductsAttribute()
    {
        if(isset($this->attributes['product_id'])){

            return Product::where('id',$this->attributes['product_id'])->first(['id','name','image'])->setAppends(['imagePath']);
        }
        return null;
    }
    public function getServiceNameAttribute()
    {
        return Service::where('id',$this->attributes['service_id'])->first()->name;
    }
}
