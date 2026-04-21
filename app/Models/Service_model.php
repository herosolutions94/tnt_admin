<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_model extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'tagline',
        'short_desc',
        'image',
        'content',
        'status',
        'featured',
    ];

}
