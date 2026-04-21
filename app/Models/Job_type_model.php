<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_type_model extends Model
{
    use HasFactory;
    protected $table = 'job_type';
    protected $fillable = [
        'name',
        'status',
        'slug'
    ];
    // function blog_posts(){
    //     return $this->hasMany(Blog_model::class,'category','id')->where('status',1);
    // }
}
