<?php

namespace App\Http\Requests;

use App\Enums\ChannelTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'channels' => ['required', 'array'],
            'channels.*' => ['required', 'string', Rule::in(ChannelTypesEnum::getValues())],
            'scheduled_at' => ['required', 'date'],
            'is_public' => ['required', 'boolean'],
        ];
    }
}
