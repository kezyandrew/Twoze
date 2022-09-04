<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offer';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath'];
    
    public function getImagePathAttribute()
    {
        return url('images/offer') . '/';
    }
}
