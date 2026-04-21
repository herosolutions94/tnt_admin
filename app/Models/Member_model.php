<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member_model extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $hidden = ['mem_password'];
    protected $fillable = [
        'mem_type',
        'mem_fname',
        'mem_lname',
        'mem_mname',
        'mem_email',
        'mem_phone',
        'mem_password',
        'mem_dob',
        'mem_address1',
        'mem_address2',
        'mem_city',
        'mem_state',
        'mem_zip',
        'mem_bio',
        'mem_image',
        'mem_status',
        'mem_verified',
        'mem_email_verified',
        'mem_phone_verified',
        'otp',
        'mem_country',
        'mem_fullname',
        'mem_business',
        'mem_domain_name',
        'otp_phone',
        'otp_expire',
        'landlordId',
        'renterId',
        'email_change',
        'phone_change',
        'googleId',
        'dob',
        'verification_expiry_date',
        "verification_status",
        "super_admin",
        "mem_employee",
        "permissions",
        "mem_display_name",
        "is_deactivated",
        "deactivated_reason",
        "mem_id_verified",
        "mem_username",
        "mem_buisness_phone",
        "is_profile_completed",
        "longitude",
        "latitude",
        "mem_address_place_id",
        "mem_agent_id"
    ];
    public function agent_row()
    {
        return $this->hasOne(Agent_model::class, 'mem_id', 'id');
    }

    public function teamMemberRow()
    {
        return $this->belongsTo(Team_member_model::class, 'team_member_id', 'id');
    }

}
