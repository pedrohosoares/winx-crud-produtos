<?php

namespace App\Models\Log;

use App\Models\Product\Category;
use Illuminate\Database\Eloquent\Model;

class CategoryLog extends Model
{
    protected $fillable = [
        'category_id', 
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
