<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    protected $fillable = [
        'sale_number',
        'sale_date',
        'grand_total',
    ];

    protected $casts = [
        'sale_date' => 'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
}