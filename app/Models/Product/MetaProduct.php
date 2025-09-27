<?php
namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaProduct extends Model
{
    protected $fillable = [
        'name',
        'value'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}