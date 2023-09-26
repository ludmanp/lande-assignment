<?php

namespace App\Http\Controllers\Loans;

use App\Http\Controllers\Controller;
use App\Http\Requests\Loans\EuriborAdjustFormRequest;
use App\Models\Loan;
use App\Models\LoanEuribor;
use App\Services\RepaymentPlanService;

class EuriborAdjustController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(
        EuriborAdjustFormRequest $request,
        RepaymentPlanService $repaymentPlanService
    )
    {
        /** @var Loan $loan */
        $loan = Loan::find($request->get('loanId'));
        /** @var LoanEuribor $euribor */
        $euribor = LoanEuribor::query()
            ->where('loan_id', $request->get('loanId'))
            ->where('segment_nr', $request->get('segmentNr'))
            ->first();
        if($euribor) {
            $euribor->rate_in_basis_points = $request->get('euriborRateInBasisPoints');
            $euribor->save();
        } else {
            $euribor = new LoanEuribor();
            $euribor->segment_nr = $request->get('segmentNr');
            $euribor->rate_in_basis_points = $request->get('euriborRateInBasisPoints');
            $loan->euribors()->save($euribor);
        }
        $loan->load('euribors');

        return response()->json([
            'loanId' => $loan->id,
            'repaymentPlan' => $repaymentPlanService->calculate($loan)
        ]);
    }
}
