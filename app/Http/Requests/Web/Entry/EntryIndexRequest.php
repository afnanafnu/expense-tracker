<?php

namespace App\Http\Requests\Web\Entry;

use Illuminate\Foundation\Http\FormRequest;

class EntryIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'page' => ['nullable', 'integer', 'min:1'],
        ];
    }
}