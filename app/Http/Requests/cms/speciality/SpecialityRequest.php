<?php

namespace App\Http\Requests\cms\speciality;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class SpecialityRequest extends FormRequest
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
        return [
            'title' => 'required',
            'page_type_id'=> 'required',
            'image'=> 'required',
        ];
    }
}
