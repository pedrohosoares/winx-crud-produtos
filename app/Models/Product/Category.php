<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes, HasFactory;

    public $fillable = [
        'name'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
