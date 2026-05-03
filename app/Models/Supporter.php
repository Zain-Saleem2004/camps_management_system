<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'website_link',
        'aid_sector',
        'logo_path',
        'about',
        'terms',
        'added_by',
    ];
}
