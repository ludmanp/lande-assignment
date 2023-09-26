<?php

namespace App\Http\Requests\Loans;

use App\Models\Loan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class EuriborAdjustFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'loanId' => 'required',
            'segmentNr' => 'required|integer|min:1',
            'euriborRateInBasisPoints' => 'required|integer',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            /** @var Loan $loan */
            $loan = Loan::find($this->get('loanId'));
            if(!$loan) {
                $validator->errors()->add('loanId', 'Loan not found');
            } else {
                if($this->get('segmentNr') > $loan->term) {
                    $validator->errors()->add('segmentNr', 'Invalid segment number for this loan');
                }
            }
        });
    }
}
