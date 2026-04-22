<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request_Quote_model extends Model
{
    use HasFactory;
    protected $table = 'request_quote';
    protected $fillable = [
        'name',
        'fname',
        'lname',
        'email',
        'phone',
        'tiktok',
        'status',
        'instagram',
        'followers',
        'experience',
        'why',
        'availability'

    ];
}