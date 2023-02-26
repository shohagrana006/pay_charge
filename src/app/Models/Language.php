<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Language extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user name who create this language
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by','id');
    }
    /**
     * Get the user name who edit this
     */
    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by','id');
    }
}
