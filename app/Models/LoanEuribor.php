<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $loan_id
 * @property int $segment_nr
 * @property int $rate_in_basis_points
 * @property Loan loan
 */
class LoanEuribor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loan(): BelongsTo
    {
        $this->belongsTo(Loan::class);
    }
}
