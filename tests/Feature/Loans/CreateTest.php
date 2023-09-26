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

    /**
     * @dataProvider provideRequests
     */
    public function testIncorrectRequestFail($requestData, $expectedContent): void
    {
        $response = $this->postJson('/api/loan', $requestData);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($expectedContent, $content);
    }

    public static function provideRequests()
    {
        return [
            [
                [
                    'amountInCents' => 'hundred',
                    'term' => 12,
                    'interestRateInBasisPoints' => 400,
                    'euriborRateInBasisPoints' => 394
                ],
                [
                    "message" => "The amount in cents field must be an integer.",
                    "errors" => [
                        "amountInCents" => [
                            "The amount in cents field must be an integer."
                        ]
                    ]
                ]
            ],
            [
                [
                    'term' => 12,
                    'interestRateInBasisPoints' => 400,
                    'euriborRateInBasisPoints' => 394
                ],
                [
                    "message" => "The amount in cents field is required.",
                    "errors" => [
                        "amountInCents" => [
                            "The amount in cents field is required."
                        ]
                    ]
                ]
            ],
            [
                [
                    'amountInCents' => 100000,
                    'term' => 'twelve',
                    'interestRateInBasisPoints' => 400,
                    'euriborRateInBasisPoints' => 394
                ],
                [
                    "message" => "The term field must be an integer.",
                    "errors" => [
                        "term" => [
                            "The term field must be an integer."
                        ]
                    ]
                ]
            ],
            [
                [
                    'amountInCents' => 100000,
                    'interestRateInBasisPoints' => 400,
                    'euriborRateInBasisPoints' => 394
                ],
                [
                    "message" => "The term field is required.",
                    "errors" => [
                        "term" => [
                            "The term field is required."
                        ]
                    ]
                ]
            ],
            [
                [
                    'amountInCents' => 1000000,
                    'term' => 12,
                    'interestRateInBasisPoints' => '4,3',
                    'euriborRateInBasisPoints' => 394
                ],
                [
                    "message" => "The interest rate in basis points field must be an integer.",
                    "errors" => [
                        "interestRateInBasisPoints" => [
                            "The interest rate in basis points field must be an integer."
                        ]
                    ]
                ]
            ],
            [
                [
                    'amountInCents' => 100000,
                    'term' => 12,
                    'euriborRateInBasisPoints' => 394
                ],
                [
                    "message" => "The interest rate in basis points field is required.",
                    "errors" => [
                        "interestRateInBasisPoints" => [
                            "The interest rate in basis points field is required."
                        ]
                    ]
                ]
            ],
            [
                [
                    'amountInCents' => 1000000,
                    'term' => 12,
                    'interestRateInBasisPoints' => 400,
                    'euriborRateInBasisPoints' => 3.94
                ],
                [
                    "message" => "The euribor rate in basis points field must be an integer.",
                    "errors" => [
                        "euriborRateInBasisPoints" => [
                            "The euribor rate in basis points field must be an integer."
                        ]
                    ]
                ]
            ],
            [
                [
                    'amountInCents' => 100000,
                    'term' => 12,
                    'interestRateInBasisPoints' => 394
                ],
                [
                    "message" => "The euribor rate in basis points field is required.",
                    "errors" => [
                        "euriborRateInBasisPoints" => [
                            "The euribor rate in basis points field is required."
                        ]
                    ]
                ]
            ],
        ];
    }
}
