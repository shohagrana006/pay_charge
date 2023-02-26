<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory;
    use HasTranslations;

    public $translatable = ['qsn','ans'];
    protected $guarded = [];


    /**
     * get package created by name
     */
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    /**
     * get package created by name
     */
    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }

}
