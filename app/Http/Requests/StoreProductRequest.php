<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title.am' => 'required|string',
            'title.en' => 'nullable|string',
            'title.ru' => 'nullable|string',
            'description.am' => 'required|string',
            'description.en' => 'nullable|string',
            'description.ru' => 'nullable|string',
            'price' => 'nullable',
            'count' => 'nullable',
            'images' => 'required|array',
            'is_published' => 'nullable',
            'is_private' => 'nullable',
            'category_id' => 'required',
            'tags' => 'nullable|array',
        ];
    }
}
