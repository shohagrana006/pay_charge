<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * user payment log
     */

     public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
     }

     /**
      * payment method
      */

      public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class, 'method_id', 'id');
      }
}
