<?php

namespace Tests\Traits;

trait TestPlans
{
    private function plan1()
    {
        return json_decode(
            '{
                    "1": {
                        "principalPaymentInCents": 81817,
                        "interestPaymentInCents": 3333,
                        "euriborPaymentInCents": 3283,
                        "totalPaymentInCents": 88433
                    },
                    "2": {
                        "principalPaymentInCents": 82089,
                        "interestPaymentInCents": 3061,
                        "euriborPaymentInCents": 3015,
                        "totalPaymentInCents": 88165
                    },
                    "3": {
                        "principalPaymentInCents": 82363,
                        "interestPaymentInCents": 2787,
                        "euriborPaymentInCents": 2745,
                        "totalPaymentInCents": 87895
                    },
                    "4": {
                        "principalPaymentInCents": 82637,
                        "interestPaymentInCents": 2512,
                        "euriborPaymentInCents": 2475,
                        "totalPaymentInCents": 87624
                    },
                    "5": {
                        "principalPaymentInCents": 82913,
                        "interestPaymentInCents": 2237,
                        "euriborPaymentInCents": 2203,
                        "totalPaymentInCents": 87353
                    },
                    "6": {
                        "principalPaymentInCents": 83189,
                        "interestPaymentInCents": 1961,
                        "euriborPaymentInCents": 1931,
                        "totalPaymentInCents": 87081
                    },
                    "7": {
                        "principalPaymentInCents": 83467,
                        "interestPaymentInCents": 1683,
                        "euriborPaymentInCents": 1658,
                        "totalPaymentInCents": 86808
                    },
                    "8": {
                        "principalPaymentInCents": 83745,
                        "interestPaymentInCents": 1405,
                        "euriborPaymentInCents": 1384,
                        "totalPaymentInCents": 86534
                    },
                    "9": {
                        "principalPaymentInCents": 84024,
                        "interestPaymentInCents": 1126,
                        "euriborPaymentInCents": 1109,
                        "totalPaymentInCents": 86259
                    },
                    "10": {
                        "principalPaymentInCents": 84304,
                        "interestPaymentInCents": 846,
                        "euriborPaymentInCents": 833,
                        "totalPaymentInCents": 85983
                    },
                    "11": {
                        "principalPaymentInCents": 84585,
                        "interestPaymentInCents": 565,
                        "euriborPaymentInCents": 556,
                        "totalPaymentInCents": 85706
                    },
                    "12": {
                        "principalPaymentInCents": 84867,
                        "interestPaymentInCents": 283,
                        "euriborPaymentInCents": 279,
                        "totalPaymentInCents": 85429
                    }
                }',
            true
        );
    }

    private function plan2()
    {
        return json_decode(
            '{
                    "1": {
                        "principalPaymentInCents": 81817,
                        "interestPaymentInCents": 3333,
                        "euriborPaymentInCents": 3283,
                        "totalPaymentInCents": 88433
                    },
                    "2": {
                        "principalPaymentInCents": 82089,
                        "interestPaymentInCents": 3061,
                        "euriborPaymentInCents": 3015,
                        "totalPaymentInCents": 88165
                    },
                    "3": {
                        "principalPaymentInCents": 82363,
                        "interestPaymentInCents": 2787,
                        "euriborPaymentInCents": 2745,
                        "totalPaymentInCents": 87895
                    },
                    "4": {
                        "principalPaymentInCents": 82637,
                        "interestPaymentInCents": 2512,
                        "euriborPaymentInCents": 2475,
                        "totalPaymentInCents": 87624
                    },
                    "5": {
                        "principalPaymentInCents": 82913,
                        "interestPaymentInCents": 2237,
                        "euriborPaymentInCents": 2203,
                        "totalPaymentInCents": 87353
                    },
                    "6": {
                        "principalPaymentInCents": 83189,
                        "interestPaymentInCents": 1961,
                        "euriborPaymentInCents": 2010,
                        "totalPaymentInCents": 87160
                    },
                    "7": {
                        "principalPaymentInCents": 83467,
                        "interestPaymentInCents": 1683,
                        "euriborPaymentInCents": 1725,
                        "totalPaymentInCents": 86875
                    },
                    "8": {
                        "principalPaymentInCents": 83745,
                        "interestPaymentInCents": 1405,
                        "euriborPaymentInCents": 1440,
                        "totalPaymentInCents": 86590
                    },
                    "9": {
                        "principalPaymentInCents": 84024,
                        "interestPaymentInCents": 1126,
                        "euriborPaymentInCents": 1154,
                        "totalPaymentInCents": 86304
                    },
                    "10": {
                        "principalPaymentInCents": 84304,
                        "interestPaymentInCents": 846,
                        "euriborPaymentInCents": 867,
                        "totalPaymentInCents": 86017
                    },
                    "11": {
                        "principalPaymentInCents": 84585,
                        "interestPaymentInCents": 565,
                        "euriborPaymentInCents": 579,
                        "totalPaymentInCents": 85729
                    },
                    "12": {
                        "principalPaymentInCents": 84867,
                        "interestPaymentInCents": 283,
                        "euriborPaymentInCents": 290,
                        "totalPaymentInCents": 85440
                    }
                }',
            true
        );
    }

    private function plan3()
    {
        return json_decode(
            '{
                    "1": {
                        "principalPaymentInCents": 81817,
                        "interestPaymentInCents": 3333,
                        "euriborPaymentInCents": 3283,
                        "totalPaymentInCents": 88433
                    },
                    "2": {
                        "principalPaymentInCents": 82089,
                        "interestPaymentInCents": 3061,
                        "euriborPaymentInCents": 3015,
                        "totalPaymentInCents": 88165
                    },
                    "3": {
                        "principalPaymentInCents": 82363,
                        "interestPaymentInCents": 2787,
                        "euriborPaymentInCents": 2745,
                        "totalPaymentInCents": 87895
                    },
                    "4": {
                        "principalPaymentInCents": 82637,
                        "interestPaymentInCents": 2512,
                        "euriborPaymentInCents": 2475,
                        "totalPaymentInCents": 87624
                    },
                    "5": {
                        "principalPaymentInCents": 82913,
                        "interestPaymentInCents": 2237,
                        "euriborPaymentInCents": 2203,
                        "totalPaymentInCents": 87353
                    },
                    "6": {
                        "principalPaymentInCents": 83189,
                        "interestPaymentInCents": 1961,
                        "euriborPaymentInCents": 2010,
                        "totalPaymentInCents": 87160
                    },
                    "7": {
                        "principalPaymentInCents": 83467,
                        "interestPaymentInCents": 1683,
                        "euriborPaymentInCents": 1725,
                        "totalPaymentInCents": 86875
                    },
                    "8": {
                        "principalPaymentInCents": 83745,
                        "interestPaymentInCents": 1405,
                        "euriborPaymentInCents": 1440,
                        "totalPaymentInCents": 86590
                    },
                    "9": {
                        "principalPaymentInCents": 84024,
                        "interestPaymentInCents": 1126,
                        "euriborPaymentInCents": 1407,
                        "totalPaymentInCents": 86557
                    },
                    "10": {
                        "principalPaymentInCents": 84304,
                        "interestPaymentInCents": 846,
                        "euriborPaymentInCents": 1057,
                        "totalPaymentInCents": 86207
                    },
                    "11": {
                        "principalPaymentInCents": 84585,
                        "interestPaymentInCents": 565,
                        "euriborPaymentInCents": 706,
                        "totalPaymentInCents": 85856
                    },
                    "12": {
                        "principalPaymentInCents": 84867,
                        "interestPaymentInCents": 283,
                        "euriborPaymentInCents": 354,
                        "totalPaymentInCents": 85504
                    }
                }',
            true
        );
    }

    private function plan5()
    {
        return json_decode(
            '{
                    "1": {
                        "principalPaymentInCents": 81817,
                        "interestPaymentInCents": 3333,
                        "euriborPaymentInCents": 3283,
                        "totalPaymentInCents": 88433
                    },
                    "2": {
                        "principalPaymentInCents": 82089,
                        "interestPaymentInCents": 3061,
                        "euriborPaymentInCents": 3015,
                        "totalPaymentInCents": 88165
                    },
                    "3": {
                        "principalPaymentInCents": 82363,
                        "interestPaymentInCents": 2787,
                        "euriborPaymentInCents": 2487,
                        "totalPaymentInCents": 87637
                    },
                    "4": {
                        "principalPaymentInCents": 82637,
                        "interestPaymentInCents": 2512,
                        "euriborPaymentInCents": 2242,
                        "totalPaymentInCents": 87391
                    },
                    "5": {
                        "principalPaymentInCents": 82913,
                        "interestPaymentInCents": 2237,
                        "euriborPaymentInCents": 1997,
                        "totalPaymentInCents": 87147
                    },
                    "6": {
                        "principalPaymentInCents": 83189,
                        "interestPaymentInCents": 1961,
                        "euriborPaymentInCents": 2010,
                        "totalPaymentInCents": 87160
                    },
                    "7": {
                        "principalPaymentInCents": 83467,
                        "interestPaymentInCents": 1683,
                        "euriborPaymentInCents": 1725,
                        "totalPaymentInCents": 86875
                    },
                    "8": {
                        "principalPaymentInCents": 83745,
                        "interestPaymentInCents": 1405,
                        "euriborPaymentInCents": 1440,
                        "totalPaymentInCents": 86590
                    },
                    "9": {
                        "principalPaymentInCents": 84024,
                        "interestPaymentInCents": 1126,
                        "euriborPaymentInCents": 1407,
                        "totalPaymentInCents": 86557
                    },
                    "10": {
                        "principalPaymentInCents": 84304,
                        "interestPaymentInCents": 846,
                        "euriborPaymentInCents": 1057,
                        "totalPaymentInCents": 86207
                    },
                    "11": {
                        "principalPaymentInCents": 84585,
                        "interestPaymentInCents": 565,
                        "euriborPaymentInCents": 593,
                        "totalPaymentInCents": 85743
                    },
                    "12": {
                        "principalPaymentInCents": 84867,
                        "interestPaymentInCents": 283,
                        "euriborPaymentInCents": 297,
                        "totalPaymentInCents": 85447
                    }
                }',
            true
        );
    }

    private function planSixMonths()
    {
        return json_decode(
            '{
                    "1":
                    {
                        "principalPaymentInCents": 99584,
                        "interestPaymentInCents": 1000,
                        "euriborPaymentInCents": 0,
                        "totalPaymentInCents": 100584
                    },
                    "2":
                    {
                        "principalPaymentInCents": 99750,
                        "interestPaymentInCents": 834,
                        "euriborPaymentInCents": 0,
                        "totalPaymentInCents": 100584
                    },
                    "3":
                    {
                        "principalPaymentInCents": 99916,
                        "interestPaymentInCents": 668,
                        "euriborPaymentInCents": 0,
                        "totalPaymentInCents": 100584
                    },
                    "4":
                    {
                        "principalPaymentInCents": 100083,
                        "interestPaymentInCents": 501,
                        "euriborPaymentInCents": 0,
                        "totalPaymentInCents": 100584
                    },
                    "5":
                    {
                        "principalPaymentInCents": 100250,
                        "interestPaymentInCents": 334,
                        "euriborPaymentInCents": 0,
                        "totalPaymentInCents": 100584
                    },
                    "6":
                    {
                        "principalPaymentInCents": 100417,
                        "interestPaymentInCents": 167,
                        "euriborPaymentInCents": 0,
                        "totalPaymentInCents": 100584
                    }
                }',
            true
        );
    }

    private function zeroInterestPlan()
    {
        return array_fill(1, 6, [
            'principalPaymentInCents' => 100000,
            'interestPaymentInCents' => 0,
            'euriborPaymentInCents' => 0,
            'totalPaymentInCents' => 100000,
        ]);
    }

    private function zeroInterestAdjustedPlan()
    {
        $plan = array_fill(1, 5, [
            'principalPaymentInCents' => 100000,
            'interestPaymentInCents' => 0,
            'euriborPaymentInCents' => 0,
            'totalPaymentInCents' => 100000,
        ]);
        $plan[6] = [
            'principalPaymentInCents' => 100001,
            'interestPaymentInCents' => 0,
            'euriborPaymentInCents' => 0,
            'totalPaymentInCents' => 100001,
        ];
        return $plan;
    }
}
