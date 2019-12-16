<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        switch ($this->method()) {
            case "GET":
            case "DELETE":
                return [];
                break;

            case "POST":
                return [
                    'products' => 'required|array',
                ];
                break;

            case "PUT":
            case "PATCH": {
                    return [
                        'products' => 'required|array',
                    ];
                }
                break;
        }
    }
}
