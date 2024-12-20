<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaketUpdateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image'],
            'title' => ['required', 'max:255', 'string'],
            'fasilitas' => ['required', 'string'],
            'price' => ['required'],
        ];
    }
}