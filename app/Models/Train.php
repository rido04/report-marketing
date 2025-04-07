<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    protected $fillable =
    [
        'company_id',
        'media_name',
        'station_name',
        'display_date',
        'device_name',
        'longitude',
        'latitude'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
