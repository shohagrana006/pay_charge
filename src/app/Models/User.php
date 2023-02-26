<?php

namespace App\Models;

use App\Events\UserCreatedEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user name who create this brand
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }
    /**
     * Get the user name who edit this
     */
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'id');
    }

    /**
     * get all active user
     */
    public function scopeActive($query)
    {
        return $query->where('status','Active');
    }

    /**
     * get user package
     */
    public function package()
    {
        return $this->hasMany(UserPackage::class, 'user_id', 'id')->latest();
    }

    /**
     * user order
     */

    public function order()
    {
        return $this->hasMany(Order::class, 'user_id', 'id')->latest();
    }
    /**
     * user payment logs
     */

    public function paymentLogs()
    {
        return $this->hasMany(PaymentLog::class, 'user_id', 'id')->latest();
    }

    /**
     * user payment logs
     */

    public function links()
    {
        return $this->hasMany(Link::class, 'user_id', 'id')->latest();
    }

}
