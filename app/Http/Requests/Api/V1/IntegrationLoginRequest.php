<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\MarketplaceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IntegrationLoginRequest extends FormRequest
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
            'marketplace' => ['required', Rule::in(MarketplaceType::cases())],
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:3']
        ];
    }
}
