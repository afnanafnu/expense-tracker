<?php

namespace App\Http\Requests\Web\Entry;

use Illuminate\Foundation\Http\FormRequest;

class AddEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:income,expense'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'transaction_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Please enter a title.',
            'category_id.required' => 'Please select a category.',
            'type.required' => 'Please select a transaction type.',
            'amount.required' => 'Please enter an amount.',
            'amount.min' => 'Amount must be greater than 0.',
            'transaction_date.required' => 'Please select a date.',
        ];
    }
}