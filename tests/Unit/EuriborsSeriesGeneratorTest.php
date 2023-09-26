<?php

namespace Tests\Unit;

use App\Models\Loan;
use App\Models\LoanEuribor;
use Tests\TestCase;

class EuriborsSeriesGeneratorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testOneEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->create([
                'term' => 12,
            ]);

        $euriborsSeries = euriborsSeries($loan->euribors, $loan->term);
        $euriborKeys = [];
        $euriborRates = [];
        foreach ($euriborsSeries as $key => $euriborRate) {
            $euriborKeys[] = $key;
            $euriborRates[] = $euriborRate;
        }
        $this->assertCount(12, $euriborRates);
        $this->assertEquals(array_fill(0, 12, 394), $euriborRates);
        $this->assertEquals(range(1, 12), $euriborKeys);
    }

    public function testTwoEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->create([
                'term' => 12,
            ]);

        $euribor = LoanEuribor::factory()->make(['segment_nr' => 6, 'rate_in_basis_points' => 410]);
        $loan->euribors()->save($euribor);

        $euriborsSeries = euriborsSeries($loan->euribors, $loan->term);
        $euriborKeys = [];
        $euriborRates = [];
        foreach ($euriborsSeries as $key => $euriborRate) {
            $euriborKeys[] = $key;
            $euriborRates[] = $euriborRate;
        }
        $this->assertCount(12, $euriborRates);
        $this->assertEquals(
            array_fill(0, 5, 394)
            + array_fill(5, 7, 410),
            $euriborRates
        );
        $this->assertEquals(range(1, 12), $euriborKeys);
    }

    public function testIgnoreOutOfRangeEuriborSuccess(): void
    {
        $loan = Loan::factory()
            ->hasEuribors(1, ['segment_nr' => 1, 'rate_in_basis_points' => 394])
            ->create([
                'term' => 12,
            ]);

        $euribor = LoanEuribor::factory()->make(['segment_nr' => 15, 'rate_in_basis_points' => 410]);
        $loan->euribors()->save($euribor);

        $euriborsSeries = euriborsSeries($loan->euribors, $loan->term);
        $euriborRates = [];
        foreach ($euriborsSeries as $euriborRate) {
            $euriborRates[] = $euriborRate;
        }

        $this->assertEquals(array_fill(0, 12, 394), $euriborRates);
    }
}
