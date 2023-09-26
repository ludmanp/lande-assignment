<?php

namespace Tests\Feature\Loans;

use App\Models\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestPlans;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use TestPlans;

    public function testLoanWithOneEriborSuccess(): void
    {
        $response = $this->postJson('/api/loan', [
            'amountInCents' => 1000000,
            'term' => 12,
            'interestRateInBasisPoints' => 400,
            'euriborRateInBasisPoints' => 394
        ]);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($this->plan1(), $content['repaymentPlan']);
        $loan = Loan::with('euribors')->find($content['loanId']);
        $this->assertNotEmpty($loan);
        $this->assertEquals(
            [
                'amount_in_cents' => 1000000,
                'term' => 12,
                'interest_rate_in_basis_points' => 400,
            ],
            $loan->only([
                'amount_in_cents',
                'term',
                'interest_rate_in_basis_points',
            ])
        );
        $this->assertCount(1, $loan->euribors);
        $this->assertEquals(
            [
                'segment_nr' => 1,
                'rate_in_basis_points' => 394
            ],
            $loan->euribors[0]->only([
                'segment_nr',
                'rate_in_basis_points'
            ])
        );;
    }
}
