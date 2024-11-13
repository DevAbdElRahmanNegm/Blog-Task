<?php

namespace App\Http\Requests\PostRequests;

use App\Http\Requests\BaseRequest;

class UpdatePostRequest extends BaseRequest
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
            'title' => 'string|min:2',
            'content' => 'string|min:2',
            'category' => 'in:Technology,Lifestyle,Education'
        ];
    }
}
