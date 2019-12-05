<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
           case "GET":
           case "DELETE":
                   return [];
               break;

           case "POST":
            {

                $rules = [];
                foreach (config('translatable.locales') as $locale) {
                    $rules += [$locale.'.name' =>'required|min:3|unique:product_translations,name',
                             'category_id'=>'required'];
                    };
                    $rules += ['purchase_price'=>'required|not_in:0',     //
                       // 'sale_price' =>'required'
                                ];
            return $rules
            ;
        }
               break;

           case "PUT":
           case "PATCH":
               {
                   $collection = collect($this->request)->toArray();

                   $rules = [];
                   foreach (config('translatable.locales') as $locale) {
                       $rules += [$locale.'.name' =>'required|min:3|unique:product_translations,name,'.$collection['id'].',product_id'];
                       $rules += ['category_id'=>'required'];
                       };
                       $rules += ['purchase_price'=>'required|not_in:0',     //
                       // 'sale_price' =>'required'
                                ];
               return
                        $rules
               ;
           }
           break;
       }
    }
}

