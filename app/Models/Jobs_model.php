<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs_model extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable = [
        'spec_id',
        'type_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'title',
        'company_name',
        'min_salary',
        'max_salary',
        'short_detail',
        'detail',
        'application_process',
        'image',
        'country_id',
        'state_id',
        'city',
        'city_id',
        'location',
        'status',
        'featured',
        'popular',
        'slug',
    ];
    public function specialization_row()
    {
        return $this->belongsTo(Specialization_model::class, 'spec_id', 'id');
    }
    public function job_type_row()
    {
        return $this->belongsTo(Job_type_model::class, 'type_id', 'id');
    }

    public function city_row()
    {
        return $this->belongsTo(Locations_model::class, 'city_id', 'id');
    }
}
