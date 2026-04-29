<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'photo_url',
        'condition',
        'acquisition_date',
        'location',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}
