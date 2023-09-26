<?php

namespace Tests\Unit\Services;

use App\Models\Loan;
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

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->plan1(), $plan);
    }

    public function testTwoEuriborsSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->hasEuribors(1, ['segment_nr' => 6, 'rate_in_basis_points' => 410])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->plan2(), $plan);
    }

    public function testTreeEuriborsSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->hasEuribors(1, ['segment_nr' => 6, 'rate_in_basis_points' => 410])
            ->hasEuribors(1, ['segment_nr' => 9, 'rate_in_basis_points' => 500])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->plan3(), $plan);
    }

    public function testFiveEuriborsSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->hasEuribors(1, ['segment_nr' => 3, 'rate_in_basis_points' => 357])
            ->hasEuribors(1, ['segment_nr' => 6, 'rate_in_basis_points' => 410])
            ->hasEuribors(1, ['segment_nr' => 9, 'rate_in_basis_points' => 500])
            ->hasEuribors(1, ['segment_nr' => 11, 'rate_in_basis_points' => 420])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->plan5(), $plan);
    }

    public function testSixMonthsLoanSuccess(): void
    {
        $loan = Loan::factory()
            ->create([
                'term' => 6,
                'amount_in_cents' => 600000,
                'interest_rate_in_basis_points' => 200
            ]);

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->planSixMonths(), $plan);
    }

    public function testZeroInterestLoanSuccess(): void
    {
        $loan = Loan::factory()
            ->create([
                'term' => 6,
                'amount_in_cents' => 600000,
                'interest_rate_in_basis_points' => 0
            ]);

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->zeroInterestPlan(), $plan);
    }

    public function testAdjustedLatsPaymentSuccess(): void
    {
        $loan = Loan::factory()
            ->create([
                'term' => 6,
                'amount_in_cents' => 600001,
                'interest_rate_in_basis_points' => 0
            ]);

        $repaymentPlanService = new RepaymentPlanService();
        $plan = $repaymentPlanService->calculate($loan);

        $this->assertEquals($this->zeroInterestAdjustedPlan(), $plan);
    }
}
