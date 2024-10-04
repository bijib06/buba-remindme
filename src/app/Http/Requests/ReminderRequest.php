<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReminderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'description' => ['required', 'string', 'min:2', 'max:255'],
            'remind_at' => ['required', 'integer', 'min:2', 'max:50'],
            'event_at' => ['required', 'integer', 'min:1000000000'],
            'in_stock' => ['required', 'integer', 'min:1000000000'],
        ];
    }
}
