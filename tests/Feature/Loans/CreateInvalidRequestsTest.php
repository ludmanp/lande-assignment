<?php

namespace Tests\Feature\Loans;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateInvalidRequestsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider provider
     */
    public function testIncorrectRequestFail($requestData, $expectedContent): void
    {
        $response = $this->postJson('/api/loan', $requestData);

        $response->assertStatus(422);
        $content = json_decode($response->getContent(), true);
        $this->assertEquals($expectedContent, $content);
    }

    public static function provider()
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
