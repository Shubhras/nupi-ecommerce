<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'brand_name',
        'business_type',
        'mobile_number',
        'brand_email',
        'role',
        'branches',
    ];
}
