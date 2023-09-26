<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\CreateFormRequest;
use App\Models\Loan;
use App\Models\LoanEuribor;
use App\Services\RepaymentPlanService;
use Illuminate\Support\Str;

class CreateController extends Controller
{
    /**
     * Creates loan and calculates payments plan
     */
    public function __invoke(
        CreateFormRequest $request,
        RepaymentPlanService $repaymentPlanService
    )
    {
        $data = $this->transfromRequestToFields($request);
        $loan = Loan::create($data);
        $euribor = new LoanEuribor([
            'segment_nr' => 1,
            'rate_in_basis_points' => $data['euribor_rate_in_basis_points'],
        ]);
        $loan->euribors()->save($euribor);
        $loan->load('euribors');

        return response()->json([
            'loanId' => $loan->id,
            'repaymentPlan' => $repaymentPlanService->calculate($loan)
        ]);
    }

    /**
     *  Transforms request's camelCase keys to snake_case ones
     *
     * @param CreateFormRequest $request
     * @return array
     */
    private function transfromRequestToFields(CreateFormRequest $request): array
    {
        return array_combine(
            collect(array_keys($request->validated()))->map(function ($key) {
                return Str::snake($key);
            })->all(),
            array_values($request->validated())
        );
    }
}
