<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_name',
        'logo',
        'whatsapp_number',
        'instagram_url',
        'facebook_url',
        'address',
        'google_maps_url',
        'schedule',
        'primary_color',
        'secondary_color',
        'footer_text',
    ];
}
