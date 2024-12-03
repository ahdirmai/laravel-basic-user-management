<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik,' . $this->user()->id, 'regex:/^[0-9]+$/'],
            'npwpd' => ['required', 'string', 'size:16', 'unique:users,npwpd,' . $this->user()->id, 'regex:/^[0-9]+$/'],
            'nohp' => ['required', 'string', 'size:12', 'regex:/^[0-9]+$/'],
            'fotopengguna' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ];
    }
}
