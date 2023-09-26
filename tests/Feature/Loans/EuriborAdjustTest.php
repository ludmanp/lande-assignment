<?php

namespace Tests\Feature\Loans;

use App\Models\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\TestPlans;

class EuriborAdjustTest extends TestCase
{
    use RefreshDatabase;
    use TestPlans;

    public function testOneAdditionalEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);
        $response = $this->postJson('/api/loan/euribor/adjust', [
            'loanId' => $loan->id,
            'segmentNr' => 6,
            'euriborRateInBasisPoints' => 410,
        ]);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($this->plan2(), $content['repaymentPlan']);
        $loan->refresh();
        $this->assertCount(2, $loan->euribors);
        $this->assertEquals(
            [
                'segment_nr' => 6,
                'rate_in_basis_points' => 410,
            ],
            $loan->euribors[1]->only([
                'segment_nr',
                'rate_in_basis_points'
            ])
        );
    }

    public function testOverwriteAdditionalEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->hasEuribors(1, ['segment_nr' => 6, 'rate_in_basis_points' => 500])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $response = $this->postJson('/api/loan/euribor/adjust', [
            'loanId' => $loan->id,
            'segmentNr' => 6,
            'euriborRateInBasisPoints' => 410,
        ]);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($this->plan2(), $content['repaymentPlan']);
        $loan->refresh();
        $this->assertCount(2, $loan->euribors);
        $this->assertEquals(
            [
                'segment_nr' => 6,
                'rate_in_basis_points' => 410,
            ],
            $loan->euribors[1]->only([
                'segment_nr',
                'rate_in_basis_points'
            ])
        );
    }
    public function testAddThirdEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->hasEuribors(1, ['segment_nr' => 6, 'rate_in_basis_points' => 410])
            ->create([
                'term' => 12,
                'amount_in_cents' => 1000000,
                'interest_rate_in_basis_points' => 400
            ]);

        $response = $this->postJson('/api/loan/euribor/adjust', [
            'loanId' => $loan->id,
            'segmentNr' => 9,
            'euriborRateInBasisPoints' => 500,
        ]);

        $response->assertStatus(200);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($this->plan3(), $content['repaymentPlan']);
        $loan->refresh();
        $this->assertCount(3, $loan->euribors);
        $this->assertEquals(
            [
                'segment_nr' => 9,
                'rate_in_basis_points' => 500,
            ],
            $loan->euribors[2]->only([
                'segment_nr',
                'rate_in_basis_points'
            ])
        );
    }
}
