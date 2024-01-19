<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => [$this->isPost(), 'string', 'max:255'],
            'ISBN' => [$this->isPost(), 'string', 'size:13', 'unique:books'],
            'pages' => [$this->isPost(), 'integer','min:1'],
            'description' => 'string',
            'hard_cover' => 'boolean',
            'category_id' => [$this->isPost(), 'integer', 'exists:categories,id'],
        ];
    }

    private function isPost(): string {
        return $this->isMethod('POST') ? 'required' : '';
    }
}
