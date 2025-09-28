<?php
namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaProduct extends Model
{

    use HasFactory;

    public $fillable = [
        'attributes'
    ];

    protected $casts = [
        'attributes' => 'array',
    ];
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}