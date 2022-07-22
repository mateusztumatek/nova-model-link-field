<?php

namespace Mateusztumatek\NovaModelLinkField\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'term' => ['nullable', 'string'],
            'exceptResources' => ['nullable', 'array'],
            'exceptResources.*' => ['string'],
            'store_type' => ['nullable', 'string']
        ];
    }
}
