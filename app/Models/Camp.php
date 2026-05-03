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

    public function representatives()
    {
        return $this->hasMany(Representative::class);
    }

    public function representative()
    {
        return $this->hasOne(Representative::class)
            ->where('status', 'active')
            ->latestOfMany();
    }

    public function dataEntry()
    {
        return $this->hasOne(DataEntry::class);
    }
}
