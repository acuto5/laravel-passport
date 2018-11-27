<?php

declare(strict_types = 1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * Class RoleRequest
 * @package App\Http\Requests
 */
class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'title' => [
                'required',
                'string',
                'min:6',
            ],
            'discount' => 'required|min:0|max:50|numeric',
        ];

        if ($this->isMethod('POST')) {
            $rules['title'][] = 'unique:roles';
        }

        if ($this->isMethod('PUT')) {
            $rules['title'][] = Rule::unique('roles')->ignore($this->route()->parameter('role')->id);
        }

        return $rules;
    }
}
