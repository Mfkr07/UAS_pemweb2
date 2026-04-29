<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    protected $fillable = [
        'asset_id',
        'maintenance_date',
        'cost',
        'description',
        'status',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
