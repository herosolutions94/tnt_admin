<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries_model extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $fillable = [
        'name',
    ];
}
