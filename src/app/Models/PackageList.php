<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageList extends Model
{
    use HasFactory;
    protected $guarded = [];


    /**
     * get package created by name
     */
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    /**
     * get package created by name
     */
    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }

   
    /**
     * get all active package
     */
    public function scopeActive($query)
    {
        return $query->where('status','Active');
    }

    public function packageService()
    {
        return $this->belongsTo(PackageService::class, 'package_service_id', 'id');
    }
}
