<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $hidden = ['site_password'];
    protected $fillable = [
        'site_username',
        'site_password',
        'site_admin_name',
        'site_admin_type',
        'site_domain',
        'site_name',
        'site_email',
        'site_noreply_email',
        'site_phone',
        'site_fax',
        'site_logo',
        'site_logo2',
        'site_icon',
        'site_thumb',
        'site_address',
        'site_about',
        'site_copyright',
        'site_facebook',
        'site_twitter',
        'site_google',
        'site_instagram',
        'site_linkedin',
        'site_youtube',
        'site_discord',
        'site_contact_map',
        'site_meta_desc',
        'site_meta_keyword',
        'site_meta_author',
        'site_version',
        'created_at',
        'updated_at',
        'site_stripe_type',
        'site_stripe_testing_api_key',
        'site_stripe_testing_secret_key',
        'site_stripe_live_api_key',
        'site_stripe_live_secret_key',
        'site_aws_pinpount_app_id',
        'cron_5days',
        'cron_today',
        'site_listing_fee',
        'site_processing_fee',
        'site_package_cost',
        'ach_merchant_id',
        'ach_api_key',
        'ach_site_id',
        'site_walkscore_api_key',
        'site_stripe_fee',
        'site_stripe_flat_fee',
        'site_ach_fee',
        'site_ach_flat_fee',
        'site_ach_threshold',
        'site_lease_grace_period',
        'site_sandbox',
        'site_percentage',
        'site_lastlogindate',
        'site_status',
        'site_license',
        'site_email_logo',
        'site_sandbox_paypal',
        'site_live_paypal',
        'site_ft_heading1',
        'site_ft_heading2',
        'site_ft_heading3',
        'site_news_letter_text',
        'site_smtp_host',
        'site_smtp_port',
        'site_smtp_user',
        'site_smtp_pswd',
        'site_shipping_fee',
        'site_header_heading1',
        'site_header_btn1_text',
        'site_header_btn1_link',
        'site_header_heading2',
        'site_header_btn2_text',
        'site_header_btn2_link',



    ];
}
