<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;
    protected $table = 'app_setting';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $appends = ['imagePath'];
    protected $fillable = [
        'addr1', 'addr2', 'city','state','country','lat', 'long','zipcode','mapkey'
    ];
    
    public function getImagePathAttribute()
    {
        return url('images/app') . '/';
    }
}
