<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team_model extends Model
{
    use HasFactory;
    protected $table = 'team';
    protected $fillable = [
        // 'meta_title',
        // 'meta_description',
        // 'meta_keywords',
        'name',
        'designation',
        // 'email',
        // 'phone',
        // 'fb_link',
        // 'inst_link',
        // 'lin_link',
        // 'x_link',
        'ex_members',
        'bod_members',
        'team',
        // 'detail',
        'image',
        'status',
        'featured',
        // 'popular',
        'slug',
    ];
}
