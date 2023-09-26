<?php

namespace Tests\Unit\Services;

use App\Models\Loan;
use App\Models\LoanEuribor;
use App\Services\RepaymentPlanService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestPlans;

class RepaymentPlanTest extends TestCase
{
    use RefreshDatabase;
    use TestPlans;

    /**
     * A basic unit test example.
     */
    public function testOneEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $repaymenPlanService = new RepaymentPlanService();
        $plan = $repaymenPlanService->calculate($loan);

        $this->assertEquals($this->plan1(), $plan);
    }

    public function testTwoEuriborsSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $euribor = LoanEuribor::factory()->make(['segment_nr' => 6, 'rate_in_basis_points' => 410]);
        $loan->euribors()->save($euribor);

        $repaymenPlanService = new RepaymentPlanService();
        $plan = $repaymenPlanService->calculate($loan);

        $this->assertEquals($this->plan2(), $plan);
    }

    public function testZeroInterestLoanSuccess(): void
    {
        $loan = Loan::factory()
            ->create([
                'term' => 6,
                'amount_in_cents' => 600000,
                'interest_rate_in_basis_points' => 0
            ]);

        $repaymenPlanService = new RepaymentPlanService();
        $plan = $repaymenPlanService->calculate($loan);

        $this->assertEquals($this->zeroInterestPlan(), $plan);
    }

    public function testAdjustedLatsPaymetSuccess(): void
    {
        $loan = Loan::factory()
            ->create([
                'term' => 6,
                'amount_in_cents' => 600001,
                'interest_rate_in_basis_points' => 0
            ]);

        $repaymenPlanService = new RepaymentPlanService();
        $plan = $repaymenPlanService->calculate($loan);

        $this->assertEquals($this->zeroInterestAdjustedPlan(), $plan);
    }
}
