<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email_model extends Model
{
    use HasFactory;
    protected $table = 'email_content';
    protected $fillable = [
        'ckey',
        'code',
    ];
}
