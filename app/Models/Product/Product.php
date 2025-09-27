<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    public $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function meta(): HasMany
    {
        return $this->hasMany(MetaProduct::class);
    }
}
