<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignElementAdminRequest extends FormRequest
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
        if (auth()->guard()->getName() == 'admin') {
            return [
                'element' => 'required|array',
                'wlp' => 'required|integer',
            ];
        } else {
            // Define rules for other guards (non-admin users)
            return [
                'element' => 'required|array',
                'admin' => 'required|integer',
            ];
        }
    }

}
