<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interns_model extends Model
{
    use HasFactory;
    protected $table = 'our_interns';
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'time_period',
    ];
}
