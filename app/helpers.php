<?php

if (!function_exists('euriborsSeries')) {
    function euriborsSeries(\Illuminate\Database\Eloquent\Collection $loanEuribors, int $term)
    {
        $i = 1;
        $euribors = [];
        /** @var \App\Models\LoanEuribor $loanEuribor */
        foreach($loanEuribors as $loanEuribor) {
            $euribors[$loanEuribor->segment_nr] = $loanEuribor->rate_in_basis_points;
        }
        do {
            if($euribors[$i] ?? null) {
                $currentEuribor = $euribors[$i];
            }
            yield $i => $currentEuribor ?? 0;
            $i++;
        } while ($i <= $term);
    }
}
