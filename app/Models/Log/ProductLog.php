<?php

namespace App\Models\Log;

use App\Models\Product\Product;
use App\Traits\LoggingTraits;
use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{

    use LoggingTraits;

    protected $fillable = [
        'product_id', 
        'user_id', 
        'action', 
        'changes', 
        'logged_at'
    ];
    protected $casts = [
        'changes' => 'array', 
        'logged_at' => 'datetime'
    ];
}
