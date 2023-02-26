<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * get pages created by name
     */
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    /**
     * get pages created by name
     */
    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }
}
