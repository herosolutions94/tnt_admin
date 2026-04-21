<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_model extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $fillable = [
        'name',
        'fname',
        'lname',
        'email',
        'phone',
        // 'subject',
        'message',
        'hear_about_us',
        'status',
        // 'user_type',
        // 'work_type',
        // 'feedback_type',
        // 'specialization',
        // 'office'

    ];
}