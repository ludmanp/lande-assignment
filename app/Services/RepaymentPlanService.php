<?php

namespace App\Services;

use App\Models\Loan;

class RepaymentPlanService
{
    const MONTHS_IN_YEAR = 12;
    public function calculate(Loan $loan): array
    {
        $plan = [];
        $loanBalance = $loan->amount_in_cents;
        $monthlyInterestRate = $this->monthlyInterestRate($loan->interest_rate_in_basis_points);
        $monthlyPayment = $this->monthlyPayment(
            $loan->amount_in_cents,
            $monthlyInterestRate,
            $loan->term
        );
        $euribors = euriborsSeries($loan->euribors, $loan->term);
        for($i = 1; $i <= $loan->term; $i++) {
            $plan[$i] = $this->planRow(
                $monthlyInterestRate,
                $monthlyPayment,
                $euribors,
                $loanBalance
            );
        }
        if($adjustment = $this->lastPaymentAdjustmetValue($loan->amount_in_cents, $plan)) {
            $plan[$loan->term]['principalPaymentInCents'] -= $adjustment;
            $plan[$loan->term]['totalPaymentInCents'] -= $adjustment;
        }
        return $plan;
    }

    private function planRow(
        float $monthlyInterestRate,
        float $monthlyPayment,
        \Generator $loanEuriborsSeries,
        int &$loanBalance
    ): array
    {
        $interestPaymentInCents = $loanBalance * $monthlyInterestRate;
        $principalPaymentInCents = round($monthlyPayment - $interestPaymentInCents);
        $interestPaymentInCents = round($interestPaymentInCents);
        $euriborRateInBasisPoints = $loanEuriborsSeries->current();
        $loanEuriborsSeries->next();
        $euriborPaymentInCents = round($this->monthlyRate($euriborRateInBasisPoints) * $loanBalance);
        $loanBalance -= $principalPaymentInCents;
        return [
            'principalPaymentInCents' => $principalPaymentInCents,
            'interestPaymentInCents' => $interestPaymentInCents,
            'euriborPaymentInCents' => $euriborPaymentInCents,
            'totalPaymentInCents' => $principalPaymentInCents + $interestPaymentInCents + $euriborPaymentInCents,
        ];
    }

    private function monthlyRate(int $rateInBasisPoints): float
    {
        return $rateInBasisPoints / 10000 / self::MONTHS_IN_YEAR;
    }

    private function monthlyInterestRate(int $interestRateInBasisPoints): float
    {
        return $this->monthlyRate($interestRateInBasisPoints);
    }

    private function monthlyPayment(int $loanAmount, float $monthlyInterestRate, int $numberOfPyments): float
    {
        if($monthlyInterestRate) {
            return ($monthlyInterestRate * $loanAmount) / (1 - pow(1 + $monthlyInterestRate, -$numberOfPyments));
        } else {
            return $loanAmount / $numberOfPyments;
        }
    }

    private function lastPaymentAdjustmetValue(int $loanAmount, array $plan): int
    {
        $totalPrincipal = collect($plan)->sum(function($row) {
            return $row['principalPaymentInCents'];
        });
        if((int)$totalPrincipal != $loanAmount) {
            return $totalPrincipal - $loanAmount;
        }
        return 0;
    }
}
