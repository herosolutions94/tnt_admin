<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coaches_model extends Model
{
    use HasFactory;
    protected $table = 'page_coaches';
    protected $fillable = [
        'name',
        'image',
        'description',
        'followers',
        'platform',
        'status',
    ];
}
