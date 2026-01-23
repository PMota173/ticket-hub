<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamInvitationRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                // Check if already a member
                function ($attribute, $value, $fail) {
                    if ($this->route('team')->users()->where('email', $value)->exists()) {
                       $fail('This user is already a member of the team.');
                    }
                },
                // Check if already invited
                function ($attribute, $value, $fail) {
                    if ($this->route('team')->invites()->where('email', $value)->exists()) {
                        $fail('An invitation has already been sent to this email.');
                    }
                },
            ],
        ];
    }
}
