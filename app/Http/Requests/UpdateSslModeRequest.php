<?php

namespace App\Http\Requests;

use App\Enums\SslMode;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateSslModeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'ssl_mode' => ['required', new Enum(SslMode::class)],
        ];
    }
}
