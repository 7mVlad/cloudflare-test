<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'domain' => ['required', 'string'],
        ];
    }
}
