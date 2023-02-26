<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManualPayment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }
}
