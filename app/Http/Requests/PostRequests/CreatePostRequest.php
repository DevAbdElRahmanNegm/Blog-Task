<?php

namespace App\Http\Requests\PostRequests;

use App\Http\Requests\BaseRequest;

class CreatePostRequest extends BaseRequest
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
            'title' => 'required|string|min:2',
            'content' => 'required|string|min:2',
            'category' => 'required|in:Technology,Lifestyle,Education'
        ];
    }
}
