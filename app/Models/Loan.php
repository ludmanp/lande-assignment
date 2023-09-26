<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $amount_in_cents
 * @property int $term
 * @property int $interest_rate_in_basis_points
 * @property LoanEuribor[]|Collection $euribors
 */
class Loan extends Model
{
    use HasFactory;

    protected $guarded = ['euribor_rate_in_basis_points'];

    public function euribors(): HasMany
    {
        return $this->hasMany(LoanEuribor::class);
    }
}
