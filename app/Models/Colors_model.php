<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colors_model extends Model
{
    use HasFactory;
     protected $table = 'colors';
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name',
        'title',
        'heading',
        'delivery_time',
        'detail',
        'price',
        'qty',
        'image1',
        'image2',
        'description',
        'about_return',

        'status',
        'featured',
        'slug',
        'd_status',



    ];
}
