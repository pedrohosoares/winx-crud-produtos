<?php

namespace App\Models\Product;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes, HasFactory;

    public $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id'
    ];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
    
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function meta(): HasOne
    {
        return $this->hasOne(MetaProduct::class);
    }
}
