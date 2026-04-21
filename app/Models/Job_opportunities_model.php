<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_opportunities_model extends Model
{
    use HasFactory;
    protected $table = 'job_opportunities';
    protected $fillable = [
        'industry_title',
        'details',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'content',
        'slug',
        'image',
        'status',
    ];
}
