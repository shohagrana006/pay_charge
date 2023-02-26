<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * get category created by name
     */
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    /**
     * get category created by name
     */
    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }

    /**
     *  get payment method
     */
    public function paymentMethod(){
        return $this->hasMany(PaymentMethod::class,'currency_id','id');
    }
    /**
     *  get active currency
     */
    public function scopeActive($q){
        return $q->where('status','Active');
    }
}
