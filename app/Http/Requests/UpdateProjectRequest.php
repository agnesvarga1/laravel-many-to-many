<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_name' => ['required' ,  Rule::unique('projects')->ignore($this->project)],
            'description'=> 'nullable | max:2056',
            'image'=> 'nullable|image',
            'website'=>'required | url:http,https',
            'type_id'=>'nullable|exists:types,id',
            'techs' => ['exists:technologies,id']
        ];
    }
}
