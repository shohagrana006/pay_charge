<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * user order
     */
     public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
     }

    /**
     * user package
     */
     public function package(){
        return $this->belongsTo(Package::class, 'package_id', 'id');
     }
}
