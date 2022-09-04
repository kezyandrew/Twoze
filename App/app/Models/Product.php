<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath','services'];
    
    public function getImagePathAttribute()
    {
        return url('images/product') . '/';
    }

    public function getServicesAttribute()
    {
        $var = json_decode($this->service_id, true);
        return Service::whereIn('id',$var)->get();
    }
}
