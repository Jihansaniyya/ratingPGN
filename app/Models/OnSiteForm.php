<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnSiteForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'activity_survey',
        'activity_activation',
        'activity_upgrade',
        'activity_downgrade',
        'activity_troubleshoot',
        'activity_preventive_maintenance',
        'complaint',
        'action',
        'assessment',
        'signature_first_party',
        'signature_second_party',
        'first_party_name',
        'second_party_name',
        'location',
        'form_date',
    ];

    protected $casts = [
        'activity_survey' => 'boolean',
        'activity_activation' => 'boolean',
        'activity_upgrade' => 'boolean',
        'activity_downgrade' => 'boolean',
        'activity_troubleshoot' => 'boolean',
        'activity_preventive_maintenance' => 'boolean',
        'form_date' => 'date',
    ];

    /**
     * Get the customer associated with this form
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the user (petugas) who filled this form
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all maintenance devices for this form
     */
    public function maintenanceDevices()
    {
        return $this->hasMany(MaintenanceDevice::class);
    }

    /**
     * Get assessment label
     */
    public function getAssessmentLabelAttribute()
    {
        return match($this->assessment) {
            'tidak_puas' => 'Tidak Puas',
            'puas' => 'Puas',
            'sangat_puas' => 'Sangat Puas',
            default => '-'
        };
    }

    /**
     * Get activities as array
     */
    public function getActivitiesAttribute()
    {
        $activities = [];
        if ($this->activity_survey) $activities[] = 'Survey';
        if ($this->activity_activation) $activities[] = 'Activation';
        if ($this->activity_upgrade) $activities[] = 'Upgrade';
        if ($this->activity_downgrade) $activities[] = 'Downgrade';
        if ($this->activity_troubleshoot) $activities[] = 'Troubleshoot';
        if ($this->activity_preventive_maintenance) $activities[] = 'Preventive Maintenance';
        return $activities;
    }
}
