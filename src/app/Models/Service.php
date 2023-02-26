<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name'];
    protected $guarded = [];

    public function scopePackage($query)
    {
        $query->whereNotNull('package_id');
    }

    public function scopePackageNull($query)
    {
        $query->whereNull('package_id');
    }

    public function scopeActive($query)
    {
        $query->where('status', 'Active');
    }


    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function servicePackage()
    {
        return $this->belongsToMany(Package::class, 'package_services', 'package_id', 'service_id');
    }

}
