<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations_model extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = [
        'country_id',
        'state_id',
        'city',
        'slug',
        'status',

    ];

    public function country()
    {
        return $this->belongsTo(Countries_model::class, 'country_id');
    }
    public function state()
    {
        return $this->belongsTo(States_model::class, 'state_id');
    }
}
