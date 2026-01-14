<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceDevice extends Model
{
    use HasFactory;

    protected $fillable = [
        'on_site_form_id',
        'device_name',
        'serial_number',
    ];

    /**
     * Get the on-site form this device belongs to
     */
    public function onSiteForm()
    {
        return $this->belongsTo(OnSiteForm::class);
    }
}
