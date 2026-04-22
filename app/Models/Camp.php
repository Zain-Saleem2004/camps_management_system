<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Camp extends Model
{
    protected $table = 'camps';

    protected $fillable = [
        'name',
        'governorate',
        'location',
        'families_count',
        'status',
    ];

    public $timestamps = false;

    public function representative()
    {
        return $this->hasOne(Representative::class);
    }

    public function dataEntry()
    {
        return $this->hasOne(DataEntry::class);
    }
}
