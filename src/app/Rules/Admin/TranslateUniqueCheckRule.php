<?php

namespace App\Rules\Admin;

use Illuminate\Contracts\Validation\Rule;
class TranslateUniqueCheckRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $id,$model,$column;
    public function __construct($model,$column ,$id = null)
    {
        $this->id = $id;
        $this->column = $column;
        $this->model = $model;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $keyWord = [];
        $flag = 1;
        $categories = app(config('constants.options.modelNamespace').$this->model)::latest()->get();
        if($this->id){
            $categories = app(config('constants.options.modelNamespace').$this->model)::latest()->where('id','!=',$this->id)->get();
        }
        $systemLanguage  = getSystemLanguage()->pluck('code')->toArray();
        foreach($systemLanguage as $code){
            $keyWord[$code] = [];
            foreach($categories as $category){
                if($category->getTranslation($this->column,$code)){
                    array_push($keyWord[$code],$category->getTranslation($this->column,$code));
                }
            }
        }
        foreach($systemLanguage as $code){
            if(in_array($value[$code],$keyWord[$code])){
                $flag = 0;
                break;
            }
        }
        if($flag == 1){
            return true ;
        }
        else{
            return false ;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return  decode('The '.$this->column.' filed must be unique');
    }
}
