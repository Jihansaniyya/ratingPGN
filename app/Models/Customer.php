<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'cid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'cid',
        'customer_name',
        'provinsi',
        'kota_kabupaten',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'layanan_service',
        'kapasitas_capacity',
        'no_telp_pic',
        'email',
    ];

    /**
     * Get full address
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->alamat_lengkap,
            $this->kelurahan,
            $this->kecamatan,
            $this->kota_kabupaten,
            $this->provinsi
        ]);
        return implode(', ', $parts);
    }

    /**
     * Get all on-site forms for this customer
     */
    public function onSiteForms()
    {
        return $this->hasMany(OnSiteForm::class, 'customer_cid', 'cid');
    }
}
