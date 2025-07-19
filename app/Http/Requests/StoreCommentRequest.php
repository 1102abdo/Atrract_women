<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Inject post_id from route into request before validation
     */
    protected function prepareForValidation(): void
    {
        // $this->merge([
        //     'post_id' => $this->route('post_id'),
        // ]);
    }

    public function rules(): array
    {
        return [
            'content' => 'required|string|min:3',
        ];
    }
}
