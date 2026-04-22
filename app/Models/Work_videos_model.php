<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_videos_model extends Model
{
    use HasFactory;
    protected $table = 'work_videos';
    protected $fillable = [
        'name',
        'video',
        'type',
        'description',
        'views',
        'status',
    ];
}
