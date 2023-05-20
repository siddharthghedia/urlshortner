<?php

namespace App\Http\Requests;

class SaveUrlRequest extends ApiFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'long_url' => 'required|url',
            'private' => 'sometimes|in:0,1'
        ];
    }
}
