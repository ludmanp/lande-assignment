<?php

namespace App\Http\Requests\Loans;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'amountInCents' => 'required|integer',
            'term' => 'required|integer',
            'interestRateInBasisPoints' => 'required|integer',
            'euriborRateInBasisPoints' => 'required|integer',
        ];
    }
}
