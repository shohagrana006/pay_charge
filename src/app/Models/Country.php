<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
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
        return $this->hasMany(Service::class, 'country_id', 'id');
    }
   
}
