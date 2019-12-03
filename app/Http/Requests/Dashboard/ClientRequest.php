<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'name' => 'required|min:4',
                    'mobile' => 'required|min:7|unique:clients,mobile',
                    'phone' => 'nullable|min:7|unique:clients,phone',
                    'address' => 'nullable|min:10',

                ];
                break;

            case "PUT":
            case "PATCH": {
                    $collection = collect($this->request)->toArray();
                    return [
                        'name' => 'required|min:4',
                        'mobile' => 'required|min:7|unique:clients,mobile,' . $collection['id'],
                        'phone' => 'nullable|min:7|unique:clients,phone,' . $collection['id'],
                        'address' => 'nullable|min:10',
                    ];
                }
                break;
        }
    }
}
