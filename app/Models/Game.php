<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'platform',
        'image',
        'category_id',
        'price_per_day'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}