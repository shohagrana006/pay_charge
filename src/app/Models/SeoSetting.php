<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class SeoSetting extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['meta_title','meta_description'];
    protected $guarded = [];
    /**
     * get seo created by name
     */
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }

    /**
     * get seo created by name
     */
    public function updatedBy(){
        return $this->belongsTo(Admin::class,'updated_by','id');
    }

}
