<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ServiceCategory extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['name','slug'];
    protected $guarded = [];

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }
    public function service()
    {
        return $this->hasMany(Service::class, 'service_category_id', 'id');
    }
}
