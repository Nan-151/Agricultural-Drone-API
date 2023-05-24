<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DroneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(['success' => false, 'message' => $validator->errors()], 412));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>[
                "required",
                "min:1",
                "max:100",
                Rule::unique('drones')->ignore($this->drone)
            ],
            "battery"=>"required|max:100",
            "max_altitude"=>"required|max:50000",
            "max_range"=>"required|max:10",
            "max_speed"=>"required|max:100",
            "payload" => "required|max:2",
            "user_id" =>"required",
            "drone_type_id"=>"required"
        ];
    }
}
