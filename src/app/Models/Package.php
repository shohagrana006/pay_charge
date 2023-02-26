<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Package extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name','title'];
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

    public function servicePackage()
    {
        return $this->belongsToMany(Service::class, 'package_services', 'package_id', 'service_id');
    }


}
