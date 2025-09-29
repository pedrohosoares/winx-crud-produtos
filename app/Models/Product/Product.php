<?php

namespace App\Models\Product;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    ];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }
    
    public function category(): BelongsToMany
    {
        return $this->belongsToMany(Category::class,'category_product');
    }

    public function meta(): HasOne
    {
        return $this->hasOne(MetaProduct::class);
    }
}
